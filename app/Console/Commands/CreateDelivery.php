<?php

namespace App\Console\Commands;

use App\Foundation\MarshalsRequests;
use Illuminate\Console\Command;
use Quicksilver\Application\Delivery;
use Quicksilver\Domain;

class CreateDelivery extends Command
{
    use MarshalsRequests;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delivery:create {pickupName} {pickupStreet} {pickupCity} {pickupState} {pickupPostCode}
    {dropoffName} {dropoffStreet} {dropoffCity} {dropoffState} {dropoffPostCode} {priority}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new delivery.';

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
     * @param Delivery\Create $create
     * @return mixed
     */
    public function handle(Delivery\Create $create)
    {
        $request = $this->marshalFromArray(Delivery\CreateRequest::class, $this->argument());

        $delivery = $create($request);

        $this->info('Delivery created.');
        $this->table(['id', 'status'], [[$delivery->getId(), $delivery->getStatus()->getValue()]]);
    }
}
