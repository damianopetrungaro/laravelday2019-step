<?php

declare(strict_types=1);

namespace App\Http\Middleware\Validation;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\ValueObjects\Address;
use App\ValueObjects\CustomerDetails;
use App\ValueObjects\Exception\AddressCityIsEmpty;
use App\ValueObjects\Exception\AddressCountryIsEmpty;
use App\ValueObjects\Exception\AddressRingNameIsEmpty;
use App\ValueObjects\Exception\AddressStateIsEmpty;
use App\ValueObjects\Exception\AddressStreetIsEmpty;
use App\ValueObjects\Exception\AddressZipCodeIsEmpty;
use App\ValueObjects\Exception\CustomerFirstNameIsEmpty;

final class CustomerDetailsValidation
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $details = new CustomerDetails(
                $request->get('customer_first_name', ''),
                $request->get('customer_last_name', ''),
                $this->address($request->get('customer_billing_address', [])),
                $this->address($request->get('customer_delivery_address', []))
            );
            $request[CustomerDetails::class] = $details;
        } catch (
        CustomerFirstNameIsEmpty |
        CustomerFirstNameIsEmpty |
        AddressStreetIsEmpty |
        AddressCityIsEmpty |
        AddressStateIsEmpty |
        AddressCountryIsEmpty |
        AddressZipCodeIsEmpty |
        AddressRingNameIsEmpty $e
        ) {
            return new Response($e->getMessage(), 422);
        }

        return $next($request);
    }

    private function address(array $address): Address
    {
        return new Address(
            $address['street'] ?? '',
            $address['city'] ?? '',
            $address['state'] ?? '',
            $address['country'] ?? '',
            $address['zip_code'] ?? '',
            $address['ring_name'] ?? '',
        );
    }
}
