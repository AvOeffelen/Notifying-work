<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SignUserAndCompanyUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'signup:user {email : Use an email} {name : Your name, this will also be used to generate a company name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used in the development phase to quickly generate a user and company.';

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
        $email = $this->argument('email');
        $name = $this->argument('name');

        $this->info("starting to generate users details");

    }
}
