<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CmsInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:install {--force : Force install without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install CMC Requirements to run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->option('force')){
            $this->proceed();
        }else{
            if($this->confirm('Are you sure to delete all current data and install the default one ?'))
            {
                $this->proceed();
            }
        }
    }

    protected function proceed(){
        // storage link
        $this->callSilent('storage:link');
        $this->call('migrate:fresh',[
            '--force' => true
        ]);

        $this->call('db:seed', [
            '--force' => true
        ]);

        $this->info('Installed Successfully');
    }
}
