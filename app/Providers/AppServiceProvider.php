<?php

declare(strict_types=1);

namespace App\Providers;

use App\Logs\SymfonyLog;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        LogViewer::extend('symfony', SymfonyLog::class);
    }
}
