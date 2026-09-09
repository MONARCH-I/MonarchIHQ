<?php

use App\Filament\Pages\Dashboard;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\BackupService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('admin can access filament dashboard with live data tabs', function () {
    $admin = User::factory()->create([
        'is_super_admin' => true,
        'email_verified_at' => now(),
    ]);

    $category = Category::create([
        'name' => 'SaaS Plans',
        'slug' => 'saas-plans',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Monarchi Enterprise AI Suite',
        'slug' => 'monarchi-enterprise-ai-suite',
        'sku' => 'SaaS-001',
        'price' => 1500.00,
        'stock_quantity' => 100,
        'is_active' => true,
    ]);

    $order = Order::create([
        'user_id' => $admin->id,
        'payment_reference' => 'MHQ_TEST_LIVE_01',
        'status' => 'processing',
        'payment_status' => 'paid',
        'payment_method' => 'paystack',
        'currency' => 'GHS',
        'total' => 1500.00,
        'customer_name' => $admin->name,
        'customer_email' => $admin->email,
    ]);

    Livewire::actingAs($admin)
        ->test(Dashboard::class)
        ->assertSuccessful()
        ->assertSee('Overview & Financials')
        ->assertSee('SaaS & Software')
        ->assertSee('Hardware & IoT')
        ->assertSee('Backup & Restore')
        ->assertSee('1,500.00')
        ->call('setTab', 'saas')
        ->assertSee('Monarchi Enterprise AI Suite')
        ->call('setTab', 'backups')
        ->assertSee('Create Snapshot Now');
});

test('backup service creates, lists, restores, and deletes database snapshots', function () {
    $service = new BackupService;

    // Create backup
    $createResult = $service->createBackup();
    expect($createResult['success'])->toBeTrue();
    expect($createResult['filename'])->toStartWith('monarchi_backup_');

    // List backups
    $list = $service->listBackups();
    expect(count($list))->toBeGreaterThanOrEqual(1);
    expect($list[0]['filename'])->toBe($createResult['filename']);

    // Restore backup
    $restoreResult = $service->restoreBackup($createResult['filename']);
    expect($restoreResult['success'])->toBeTrue($restoreResult['message'] ?? 'Failed restoring backup');

    // Delete backup
    $deleteResult = $service->deleteBackup($createResult['filename']);
    expect($deleteResult['success'])->toBeTrue();
});

test('backup service uploads, verifies, and deletes uploaded backup files', function () {
    $service = new BackupService;

    // Fake an uploaded .sql file
    $sqlContent = "-- Test SQL dump\nSELECT 1;\n";
    $uploadedFile = UploadedFile::fake()->createWithContent('custom_test_backup.sql', $sqlContent);

    $uploadResult = $service->uploadBackup($uploadedFile);
    expect($uploadResult['success'])->toBeTrue();
    expect($uploadResult['filename'])->toContain('custom_test_backup_uploaded_');

    // List backups and verify it is present
    $list = $service->listBackups();
    $found = collect($list)->firstWhere('filename', $uploadResult['filename']);
    expect($found)->not->toBeNull();

    // Clean up
    $deleteResult = $service->deleteBackup($uploadResult['filename']);
    expect($deleteResult['success'])->toBeTrue();
});

test('admin can upload backup file via dashboard', function () {
    $admin = User::factory()->create([
        'is_super_admin' => true,
        'email_verified_at' => now(),
    ]);

    $file = UploadedFile::fake()->createWithContent('livewire_upload_test.sql', "-- Test\nSELECT 1;\n");

    Livewire::actingAs($admin)
        ->test(Dashboard::class)
        ->set('backupFile', $file)
        ->call('handleUploadBackup')
        ->assertHasNoErrors();

    $service = new BackupService;
    $list = $service->listBackups();
    $found = collect($list)->first(fn ($b) => str_contains($b['filename'], 'livewire_upload_test'));
    expect($found)->not->toBeNull();

    // Clean up
    if ($found) {
        $service->deleteBackup($found['filename']);
    }
});
