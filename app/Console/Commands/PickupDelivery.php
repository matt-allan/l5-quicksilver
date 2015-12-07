<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Quicksilver\Application\Delivery;

class PickupDelivery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delivery:pickup {deliveryId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pickup a delivery';

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
     * @param Delivery\Pickup $pickup
     * @return mixed
     */
    public function handle(Delivery\Pickup $pickup)
    {
        $request = new Delivery\PickupRequest($this->argument('deliveryId'));

        $delivery = $pickup($request);

        $this->info('Delivery picked up.');
        $this->table(['id', 'status'], [[$delivery->getId(), $delivery->getStatus()->getValue()]]);
    }
}
