<?php

namespace App\Console\Commands;

use App\Aggregates\Order;
use App\Events\OrderWasDelivered;
use Illuminate\Console\Command;

final class Interact extends Command
{
    protected $signature = 'interact';

    protected $description = 'Interact with the aggregate';

    public function handle(): void
    {
        $aggregate = Order::retrieve('uuid here');
        $aggregate->recordThat(new OrderWasDelivered(new \DateTimeImmutable()));
        $aggregate->persist();
    }
}
