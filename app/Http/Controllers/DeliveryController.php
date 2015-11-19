<?php

namespace App\Http\Controllers;

use App\Foundation\MarshalsRequests;
use App\Http\Requests;
use App\Http\Transformers\DeliveryTransformer;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Quicksilver\Application\Delivery;
use Quicksilver\Domain\Delivery\Repository;
use Quicksilver\Domain\Delivery\Status;

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
        // For read methods we call the repository directly.
        // You might want to create an application service
        // for reading if you are adding query filters
        // or any additional logic that needs to be
        // reused outside of the controller.
        $deliveries = $this->deliveries->findAll();

        return fractal()
            ->collection($deliveries)
            ->transformWith(new DeliveryTransformer())
            ->toArray()
            ;
    }

    public function show($deliveryId)
    {
        $delivery = $this->deliveries->find($deliveryId);

        return fractal()
            ->item($delivery)
            ->transformWith(new DeliveryTransformer())
            ->toArray()
            ;
    }

    public function update(Delivery\Pickup $pickup, Delivery\Deliver $deliver, Request $httpRequest, $deliveryId)
    {
        // Rest APIs are pretty CRUDy, and there is only one update
        // method for any update action.  Since our domain is
        // less CRUDy, we infer the intent of the action and
        // call the appropriate application service.
        if ($httpRequest->input('status') === Status::PICKED_UP()->getValue()) {

            $request = $this->marshal(Delivery\PickupRequest::class, $httpRequest, compact('deliveryId'));
            $delivery = $pickup($request);

        } else if ($httpRequest->input('status') === Status::DELIVERED()->getValue()) {

            $request = $this->marshal(Delivery\DeliverRequest::class, $httpRequest, compact('deliveryId'));
            $delivery = $deliver($request);

        } else {
            throw new HttpResponseException(response('Unknown Request', 400));
        }

        return fractal()
            ->item($delivery)
            ->transformWith(new DeliveryTransformer())
            ->toArray()
            ;
    }

    public function store(Delivery\Create $create, Request $httpRequest)
    {
        // First we 'marshal' an application request from the HTTP request.
        $request = $this->marshal(Delivery\CreateRequest::class, $httpRequest);

        // Next we invoke our application service with the application request.
        // Any failures throw exceptions, which we catch with middleware.
        // If everything goes well, we get our response and render it.
        $delivery = $create($request);

        return fractal()
            ->item($delivery)
            ->transformWith(new DeliveryTransformer())
            ->toArray()
            ;
    }
}
