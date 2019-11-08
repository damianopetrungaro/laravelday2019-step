<?php

declare(strict_types=1);

namespace App\Repository;

use App\Aggregates\Order;
use App\ValueObjects\ID;

interface OrderRepository
{
    public function nextID(): ID;

    public function add(Order $order): void;

    public function getByID(ID $ID): Order;
}
