<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class BackupService
{
    protected string $backupDir;

    protected string $databasePath;

    public function __construct()
    {
        $this->backupDir = storage_path('app/backups');
        $this->databasePath = database_path('database.sqlite');

        if (! File::exists($this->backupDir)) {
            File::makeDirectory($this->backupDir, 0755, true);
        }
    }

    /**
     * Create a new database backup snapshot.
     * Supports both PostgreSQL (live production) and SQLite.
     */
    public function createBackup(): array
    {
        $timestamp = now()->format('Y-m-d_His');
        $connection = config('database.default', 'sqlite');

        try {
            // Case 1: Physical SQLite file exists on disk
            if ($connection === 'sqlite' && File::exists($this->databasePath) && filesize($this->databasePath) > 0) {
                $filename = "monarchi_backup_{$timestamp}.sqlite";
                $target = "{$this->backupDir}/{$filename}";
                File::copy($this->databasePath, $target);
            } else {
                // Case 2: PostgreSQL, MySQL, or In-Memory/Fresh Database -> SQL snapshot dump
                $filename = "monarchi_backup_{$timestamp}.sql";
                $target = "{$this->backupDir}/{$filename}";
                $this->exportDatabaseToSql($target, $connection);
            }

            $sizeBytes = File::exists($target) ? File::size($target) : 0;
            $sizeFormatted = $this->formatBytes($sizeBytes);

            Log::info("Database backup created successfully: {$filename} ({$sizeFormatted})");

            return [
                'success' => true,
                'filename' => $filename,
                'size' => $sizeFormatted,
                'size_bytes' => $sizeBytes,
                'created_at' => now(),
                'message' => "Backup created successfully: {$filename} ({$sizeFormatted})",
            ];
        } catch (\Throwable $e) {
            Log::error("Failed to create database backup: {$e->getMessage()}", [
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Backup creation failed: '.$e->getMessage(),
            ];
        }
    }

    /**
     * Upload an existing backup snapshot (.sqlite or .sql).
     */
    public function uploadBackup(UploadedFile $file): array
    {
        try {
            $extension = strtolower($file->getClientOriginalExtension());
            if (! in_array($extension, ['sqlite', 'sql'])) {
                return [
                    'success' => false,
                    'message' => 'Invalid file format. Only .sqlite and .sql backup files are allowed.',
                ];
            }

            $rawName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $rawName);
            $timestamp = now()->format('Y-m-d_His');
            $filename = "{$cleanName}_uploaded_{$timestamp}.{$extension}";
            $target = "{$this->backupDir}/{$filename}";

            if (method_exists($file, 'get')) {
                File::put($target, $file->get());
            } else {
                File::put($target, file_get_contents($file->getRealPath()));
            }

            $sizeBytes = File::size($target);
            $sizeFormatted = $this->formatBytes($sizeBytes);

            Log::info("Backup file uploaded successfully: {$filename} ({$sizeFormatted})");

            return [
                'success' => true,
                'filename' => $filename,
                'size' => $sizeFormatted,
                'size_bytes' => $sizeBytes,
                'message' => "Backup {$filename} ({$sizeFormatted}) uploaded successfully.",
            ];
        } catch (\Throwable $e) {
            Log::error("Failed to upload backup file: {$e->getMessage()}");

            return [
                'success' => false,
                'message' => 'Backup upload failed: '.$e->getMessage(),
            ];
        }
    }

    /**
     * List all available backup files (.sqlite and .sql).
     */
    public function listBackups(): array
    {
        if (! File::exists($this->backupDir)) {
            return [];
        }

        $files = File::files($this->backupDir);
        $backups = [];

        foreach ($files as $file) {
            $ext = strtolower($file->getExtension());
            if ($ext === 'sqlite' || $ext === 'sql') {
                $backups[] = [
                    'filename' => $file->getFilename(),
                    'size' => $this->formatBytes($file->getSize()),
                    'size_bytes' => $file->getSize(),
                    'modified' => Carbon::createFromTimestamp($file->getMTime()),
                    'path' => $file->getRealPath(),
                    'type' => strtoupper($ext),
                ];
            }
        }

        // Sort latest backups first
        usort($backups, fn ($a, $b) => $b['modified']->timestamp <=> $a['modified']->timestamp);

        return $backups;
    }

    /**
     * Restore database from a selected backup file.
     */
    public function restoreBackup(string $filename): array
    {
        $filename = basename($filename);
        $source = "{$this->backupDir}/{$filename}";

        if (! File::exists($source)) {
            return [
                'success' => false,
                'message' => 'Backup file does not exist: '.$filename,
            ];
        }

        $ext = strtolower(pathinfo($source, PATHINFO_EXTENSION));
        $connection = config('database.default', 'sqlite');

        try {
            if ($ext === 'sql') {
                $sqlContent = File::get($source);
                DB::unprepared($sqlContent);

                Log::info("Database restored successfully from SQL snapshot {$filename}");

                return [
                    'success' => true,
                    'message' => "Database successfully restored from SQL snapshot {$filename}.",
                ];
            }

            if ($ext === 'sqlite') {
                if ($connection !== 'sqlite') {
                    return [
                        'success' => false,
                        'message' => 'Cannot restore a SQLite binary file into a '.$connection.' connection directly.',
                    ];
                }

                if (File::exists($this->databasePath)) {
                    $safetyFile = "{$this->backupDir}/pre_restore_safety_".now()->format('Y-m-d_His').'.sqlite';
                    File::copy($this->databasePath, $safetyFile);
                }

                File::copy($source, $this->databasePath);

                Log::info("Database restored successfully from SQLite file {$filename}");

                return [
                    'success' => true,
                    'message' => "Database successfully restored from {$filename}.",
                ];
            }

            return [
                'success' => false,
                'message' => 'Unsupported backup file extension: '.$ext,
            ];
        } catch (\Throwable $e) {
            Log::error("Failed to restore database from backup {$filename}: {$e->getMessage()}");

            return [
                'success' => false,
                'message' => 'Database restore failed: '.$e->getMessage(),
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

    /**
     * Export database tables and data as SQL insert statements.
     */
    protected function exportDatabaseToSql(string $targetPath, string $driver): void
    {
        $sql = "-- MonarchI HQ Database Backup Snapshot\n";
        $sql .= "-- Driver: {$driver}\n";
        $sql .= '-- Created at: '.now()->toIso8601String()."\n\n";

        $tables = Schema::getTableListing();

        foreach ($tables as $table) {
            // Normalize table names if schema prefix exists
            if (str_contains($table, '.')) {
                $parts = explode('.', $table);
                $table = end($parts);
            }

            // Exclude ephemeral cache and session tables if desired, but include business tables
            if (in_array($table, ['cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs'])) {
                continue;
            }

            try {
                $rows = DB::table($table)->get();
            } catch (\Throwable $e) {
                continue;
            }

            if ($rows->isEmpty()) {
                continue;
            }

            $sql .= "-- --------------------------------------------------------\n";
            $sql .= "-- Table Data: {$table} (".$rows->count()." rows)\n";
            $sql .= "-- --------------------------------------------------------\n";

            foreach ($rows as $row) {
                $rowArray = (array) $row;
                $columns = array_keys($rowArray);
                $escapedCols = implode(', ', array_map(fn ($c) => "\"{$c}\"", $columns));

                $escapedVals = array_map(function ($value) {
                    if ($value === null) {
                        return 'NULL';
                    }
                    if (is_bool($value)) {
                        return $value ? 'TRUE' : 'FALSE';
                    }
                    if (is_int($value) || is_float($value)) {
                        return (string) $value;
                    }
                    $str = str_replace("'", "''", (string) $value);

                    return "'{$str}'";
                }, array_values($rowArray));

                $sql .= "INSERT INTO \"{$table}\" ({$escapedCols}) VALUES (".implode(', ', $escapedVals).");\n";
            }

            $sql .= "\n";
        }

        File::put($targetPath, $sql);
    }

    protected function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2).' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2).' KB';
        }

        return $bytes.' B';
    }
}
