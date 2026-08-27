<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BackupService
{
    protected string $backupDir;
    protected string $databasePath;

    public function __construct()
    {
        $this->backupDir    = storage_path('app/backups');
        $this->databasePath = database_path('database.sqlite');

        if (!File::exists($this->backupDir)) {
            File::makeDirectory($this->backupDir, 0755, true);
        }
    }

    /**
     * Create a new database backup snapshot.
     */
    public function createBackup(): array
    {
        if (!File::exists($this->databasePath)) {
            return [
                'success' => false,
                'message' => 'Active database file not found at: ' . $this->databasePath,
            ];
        }

        $timestamp = now()->format('Y-m-d_His');
        $filename  = "monarchi_backup_{$timestamp}.sqlite";
        $target    = "{$this->backupDir}/{$filename}";

        try {
            File::copy($this->databasePath, $target);

            $sizeBytes = File::size($target);
            $sizeFormatted = $this->formatBytes($sizeBytes);

            Log::info("Database backup created successfully: {$filename} ({$sizeFormatted})");

            return [
                'success'       => true,
                'filename'      => $filename,
                'size'          => $sizeFormatted,
                'size_bytes'    => $sizeBytes,
                'created_at'    => now(),
                'message'       => "Backup created successfully: {$filename} ({$sizeFormatted})",
            ];
        } catch (\Throwable $e) {
            Log::error("Failed to create database backup: {$e->getMessage()}");
            return [
                'success' => false,
                'message' => 'Backup creation failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * List all available backup files.
     */
    public function listBackups(): array
    {
        if (!File::exists($this->backupDir)) {
            return [];
        }

        $files = File::files($this->backupDir);
        $backups = [];

        foreach ($files as $file) {
            if ($file->getExtension() === 'sqlite' || $file->getExtension() === 'sql') {
                $backups[] = [
                    'filename'   => $file->getFilename(),
                    'size'       => $this->formatBytes($file->getSize()),
                    'size_bytes' => $file->getSize(),
                    'modified'   => \Carbon\Carbon::createFromTimestamp($file->getMTime()),
                    'path'       => $file->getRealPath(),
                ];
            }
        }

        // Sort latest backups first
        usort($backups, fn($a, $b) => $b['modified']->timestamp <=> $a['modified']->timestamp);

        return $backups;
    }

    /**
     * Restore database from a selected backup file.
     */
    public function restoreBackup(string $filename): array
    {
        // Sanitize filename to prevent directory traversal
        $filename = basename($filename);
        $source = "{$this->backupDir}/{$filename}";

        if (!File::exists($source)) {
            return [
                'success' => false,
                'message' => 'Backup file does not exist: ' . $filename,
            ];
        }

        try {
            // Take a quick safety snapshot before restoring
            if (File::exists($this->databasePath)) {
                $safetyFile = "{$this->backupDir}/pre_restore_safety_" . now()->format('Y-m-d_His') . ".sqlite";
                File::copy($this->databasePath, $safetyFile);
            }

            // Restore
            File::copy($source, $this->databasePath);

            Log::info("Database restored successfully from {$filename}");

            return [
                'success' => true,
                'message' => "Database successfully restored from {$filename}. A safety snapshot was also preserved.",
            ];
        } catch (\Throwable $e) {
            Log::error("Failed to restore database from backup {$filename}: {$e->getMessage()}");
            return [
                'success' => false,
                'message' => 'Database restore failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Delete a backup file.
     */
    public function deleteBackup(string $filename): array
    {
        $filename = basename($filename);
        $file = "{$this->backupDir}/{$filename}";

        if (File::exists($file)) {
            File::delete($file);
            return [
                'success' => true,
                'message' => "Backup {$filename} deleted successfully.",
            ];
        }

        return [
            'success' => false,
            'message' => 'Backup file not found.',
        ];
    }

    /**
     * Get absolute path for downloading.
     */
    public function getBackupPath(string $filename): ?string
    {
        $filename = basename($filename);
        $path = "{$this->backupDir}/{$filename}";
        return File::exists($path) ? $path : null;
    }

    protected function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }
}
