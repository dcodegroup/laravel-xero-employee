<?php

namespace Dcodegroup\LaravelXeroEmployee\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-xero-employee:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Laravel Xero Employee resources';

    /**
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Laravel Xero Employee Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'laravel-xero-employee-config']);

        if (Schema::hasTable('users') && ! class_exists('AddXeroEmployeeFieldsToUsersTable')) {
            $this->comment('Publishing Laravel Xero Employee Migrations');
            $this->callSilent('vendor:publish', ['--tag' => 'laravel-xero-employee-migrations']);
        }

        $this->info('Laravel Xero Employee scaffolding installed successfully.');
    }
}
