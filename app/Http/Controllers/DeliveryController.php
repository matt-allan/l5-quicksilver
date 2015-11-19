<?php

namespace App\Http\Controllers;

use App\Foundation\MarshalsRequests;
use App\Http\Requests;
use App\Http\Transformers\DeliveryTransformer;
use Illuminate\Http\Request;
use Quicksilver\Application\Delivery;
use Quicksilver\Domain\Delivery\Repository;

class DeliveryController extends Controller
{
    use MarshalsRequests;

    /**
     * @var Repository;
     */
    private $deliveries;

    /**
     * DeliveryController constructor.
     * @param Repository $deliveries
     */
    public function __construct(Repository $deliveries)
    {
        $this->deliveries = $deliveries;
    }

    public function index()
    {
        $deliveries = $this->deliveries->findAll();

        return fractal()
            ->collection($deliveries)
            ->transformWith(new DeliveryTransformer())
            ->toArray();
    }

    public function show($deliveryId)
    {
        $delivery = $this->deliveries->find($deliveryId);

        return fractal()
            ->item($delivery)
            ->transformWith(new DeliveryTransformer())
            ->toArray();
    }

    public function update()
    {
        //
    }

    public function store(Delivery\Create $create, Request $request)
    {
        $request = $this->marshal(Delivery\CreateRequest::class, $request);

        $delivery = $create($request);

        return fractal()
            ->item($delivery)
            ->transformWith(new DeliveryTransformer())
            ->toArray();
    }

    public function destroy($deliveryId)
    {
        //
    }
}
