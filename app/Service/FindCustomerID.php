<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Customer;
use App\ValueObjects\CustomerID;

final class FindCustomerID
{
    public function __invoke(string $id): ?CustomerID
    {
        if (!$customer = Customer::find($id)) {
            return null;
        }

        try {
            return CustomerID::fromUUID($customer['id']);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
