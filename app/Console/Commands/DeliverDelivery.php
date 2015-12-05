<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Quicksilver\Application\Delivery;

class DeliverDelivery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delivery:deliver {deliveryId} {signature}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deliver a delivery';

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
     * @param Delivery\Deliver $deliver
     * @return mixed
     */
    public function handle(Delivery\Deliver $deliver)
    {
        $request = new Delivery\DeliverRequest($this->argument('deliveryId'), $this->argument('signature'));

        $delivery = $deliver($request);

        $this->info('Delivery delivered.');
        $this->table(['id', 'status'], [[$delivery->getId(), $delivery->getStatus()->getValue()]]);
    }
}
