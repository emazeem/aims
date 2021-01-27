<?php

namespace App\Console\Commands;

use App\Models\Department;
use Illuminate\Console\Command;

class QuoteReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:quote_reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $parameter=new Department();
        $parameter->name='Command ';
        $parameter->head=1;
        $parameter->save();
        return 0;
    }
}
