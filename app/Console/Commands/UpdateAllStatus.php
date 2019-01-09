<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateAllStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run update:stu_student and run update:stu_status';

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
        $result = $this->call('update:stu_status');
        $result &= $this->call('update:stu_problem');

        return $result;
    }
}
