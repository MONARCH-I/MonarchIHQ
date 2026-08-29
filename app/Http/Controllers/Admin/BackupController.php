<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BackupService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupController extends Controller
{
    protected BackupService $backupService;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    public function download(Request $request, string $filename): BinaryFileResponse
    {
        if (! auth()->check() || ! auth()->user()->is_super_admin) {
            abort(403, 'Unauthorized access to database backups.');
        }

        $path = $this->backupService->getBackupPath($filename);

        if (! $path) {
            abort(404, 'Backup file not found.');
        }

        return response()->download($path, $filename);
    }
}
