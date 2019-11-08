<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\UseCases\PlaceOrder;
use App\ValueObjects\BookDetails;
use App\ValueObjects\BookID;
use App\ValueObjects\CustomerDetails;
use App\ValueObjects\CustomerID;

final class PlaceOrderController extends Controller
{
    /**
     * @var PlaceOrder
     */
    private $placeOrder;

    public function __construct(PlaceOrder $placeOrder)
    {
        $this->placeOrder = $placeOrder;
    }

    public function __invoke(Request $request): Response
    {
        try {
            $order = ($this->placeOrder)(
                $request->get(CustomerID::class),
                $request->get(CustomerDetails::class),
                $request->get(BookID::class),
                $request->get(BookDetails::class),
            );
        } catch (\Throwable $e) {
            return new Response($e->getMessage(), 500);
        }
        return new Response('', 201, ['Location' => "/orders/{$order->ID()}"]);
    }
}
