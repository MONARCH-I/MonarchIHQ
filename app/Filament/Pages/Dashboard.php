<?php

namespace App\Filament\Pages;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Services\BackupService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\WithFileUploads;

class Dashboard extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.dashboard';

    public string $activeTab = 'overview';

    // Backup management state
    public ?string $selectedBackupToRestore = null;

    public $backupFile = null;

    /**
     * Remove the big default header title.
     */
    public function getHeading(): string
    {
        return '';
    }

    public function getTitle(): string
    {
        return 'Dashboard';
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    /**
     * Live Data: Overview & Financials
     */
    public function getOverviewData(): array
    {
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $totalOrdersCount = Order::count();
        $paidOrdersCount = Order::where('payment_status', 'paid')->count();
        $pendingOrdersCount = Order::where('payment_status', 'pending')->count();
        $activeProductsCount = Product::where('is_active', true)->count();
        $totalCustomersCount = User::count();

        // 30-day daily sales for chart
        $dailySales = Order::where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date')
            ->toArray();

        // Recent live transactions
        $recentOrders = Order::with('items.product')
            ->latest()
            ->take(8)
            ->get();

        return [
            'totalRevenue' => $totalRevenue,
            'totalOrdersCount' => $totalOrdersCount,
            'paidOrdersCount' => $paidOrdersCount,
            'pendingOrdersCount' => $pendingOrdersCount,
            'activeProductsCount' => $activeProductsCount,
            'totalCustomersCount' => $totalCustomersCount,
            'dailySales' => $dailySales,
            'recentOrders' => $recentOrders,
        ];
    }

    /**
     * Live Data: SaaS & Software Plans
     */
    public function getSaasData(): array
    {
        $saasCategoryIds = Category::where('slug', 'like', '%saas%')
            ->orWhere('slug', 'like', '%software%')
            ->pluck('id');

        $saasProducts = Product::with('category')
            ->whereIn('category_id', $saasCategoryIds)
            ->get();

        $saasProductIds = $saasProducts->pluck('id');

        $saasSalesCount = OrderItem::whereIn('product_id', $saasProductIds)->sum('quantity');
        $saasRevenue = OrderItem::whereIn('product_id', $saasProductIds)
            ->whereHas('order', fn ($q) => $q->where('payment_status', 'paid'))
            ->sum('subtotal');

        return [
            'saasProducts' => $saasProducts,
            'saasCount' => $saasProducts->count(),
            'saasSalesCount' => $saasSalesCount,
            'saasRevenue' => $saasRevenue,
        ];
    }

    /**
     * Live Data: Hardware, Edge IoT & Inventory
     */
    public function getHardwareData(): array
    {
        $saasCategoryIds = Category::where('slug', 'like', '%saas%')
            ->orWhere('slug', 'like', '%software%')
            ->pluck('id');

        // Physical products only (exclude digital products and SaaS categories)
        $hardwareProducts = Product::with('category')
            ->where('is_digital', false)
            ->whereNotIn('category_id', $saasCategoryIds)
            ->get();

        $totalUnitsInStock = $hardwareProducts->sum('stock_quantity');
        $inventoryAssetValue = $hardwareProducts->sum(fn ($p) => ($p->price * ($p->stock_quantity ?? 0)));

        // Low stock alerts (physical products only, stock <= min threshold)
        $lowStockProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_digital', false)
            ->whereNotNull('stock_quantity')
            ->whereNotNull('min_stock_threshold')
            ->whereColumn('stock_quantity', '<=', 'min_stock_threshold')
            ->orderBy('stock_quantity')
            ->get();

        return [
            'hardwareProducts' => $hardwareProducts,
            'totalUnitsInStock' => $totalUnitsInStock,
            'inventoryAssetValue' => $inventoryAssetValue,
            'lowStockProducts' => $lowStockProducts,
            'lowStockCount' => $lowStockProducts->count(),
        ];
    }

    /**
     * Live Data: Servicing & Custom Projects Inquiries
     */
    public function getServicingData(): array
    {
        // Custom requests / orders with notes or direct inquiries
        $customOrders = Order::whereNotNull('notes')
            ->where('notes', '!=', '')
            ->latest()
            ->get();

        $customers = User::latest()->take(10)->get();

        return [
            'customOrders' => $customOrders,
            'customers' => $customers,
        ];
    }

    /**
     * Live Data: Database Backups
     */
    public function getBackupsList(): array
    {
        $backupService = app(BackupService::class);

        return $backupService->listBackups();
    }

    /**
     * Action: Create New Backup
     */
    public function handleCreateBackup(): void
    {
        $backupService = app(BackupService::class);
        $result = $backupService->createBackup();

        if ($result['success']) {
            Notification::make()
                ->title('Database Backup Created')
                ->body("File: {$result['filename']} ({$result['size']})")
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Backup Failed')
                ->body($result['message'])
                ->danger()
                ->send();
        }
    }

    /**
     * Action: Restore Backup
     */
    public function handleRestoreBackup(string $filename): void
    {
        $backupService = app(BackupService::class);
        $result = $backupService->restoreBackup($filename);

        if ($result['success']) {
            Notification::make()
                ->title('Database Restored')
                ->body($result['message'])
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Restore Failed')
                ->body($result['message'])
                ->danger()
                ->send();
        }
    }

    /**
     * Action: Delete Backup
     */
    public function handleDeleteBackup(string $filename): void
    {
        $backupService = app(BackupService::class);
        $result = $backupService->deleteBackup($filename);

        if ($result['success']) {
            Notification::make()
                ->title('Backup Deleted')
                ->body($result['message'])
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Delete Failed')
                ->body($result['message'])
                ->danger()
                ->send();
        }
    }

    /**
     * Action: Upload Backup Snapshot
     */
    public function handleUploadBackup(): void
    {
        $this->validate([
            'backupFile' => 'required|file|max:51200', // Max 50MB
        ], [
            'backupFile.required' => 'Please select a backup file (.sqlite or .sql) to upload.',
            'backupFile.max' => 'The backup file size must not exceed 50MB.',
        ]);

        $backupService = app(BackupService::class);
        $result = $backupService->uploadBackup($this->backupFile);

        $this->reset('backupFile');

        if ($result['success']) {
            Notification::make()
                ->title('Backup Snapshot Uploaded')
                ->body($result['message'])
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Upload Failed')
                ->body($result['message'])
                ->danger()
                ->send();
        }
    }
}
