<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('permission:seed', function () {
    Artisan::call('cache:clear');
    // $this->call('cache:forget', ['spatie.permission.cache']);
    $this->call('db:seed', ['--class' => 'PermissionSeeder']);
    $this->info('Permission Seeding Completed');
});

Artisan::command('re-migrate', function () {
    $this->call('migrate:rollback');
    $this->call('migrate');
    // $this->info('Re-Migration Completed');
});

Artisan::command('clear:all', function () {
    $this->call('cache:clear');
    $this->call('view:clear');
    $this->call('route:clear');
    $this->call('config:clear');
    $this->info('All Caches Cleared');
});

Artisan::command('clear:log', function () {
    exec('rm -f ' . storage_path('logs/*.log'));

    exec('rm -f ' . base_path('*.log'));

    $this->comment('Logs have been cleared!');
});