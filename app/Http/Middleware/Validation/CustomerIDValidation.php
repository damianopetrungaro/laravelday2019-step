<?php

declare(strict_types=1);

namespace App\Http\Middleware\Validation;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Service\FindCustomerID;
use App\ValueObjects\CustomerID;

final class CustomerIDValidation
{
    /**
     * @var FindCustomerID
     */
    private $findCustomerID;

    public function __construct(FindCustomerID $findCustomerID)
    {
        $this->findCustomerID = $findCustomerID;
    }

    public function handle(Request $request, Closure $next)
    {
        if (!$customerID = ($this->findCustomerID)($request->get('customer_id', ''))) {
            return new Response('customer ID does not exists', 422);
        }
        $request[CustomerID::class] = $customerID;

        return $next($request);
    }
}
