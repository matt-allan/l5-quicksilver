<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Quicksilver\Application\Customer;

class CreateCustomer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new customer';

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
     * @param Customer\Create $create
     * @return mixed
     */
    public function handle(Customer\Create $create)
    {
        $customer = $create();

        $this->info('Customer created.');
        $this->table(['id'], [[$customer->getId()]]);
    }
}
