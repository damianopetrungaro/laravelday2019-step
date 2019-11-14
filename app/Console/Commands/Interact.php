<?php

namespace App\Console\Commands;

use App\Aggregates\Order;
use App\Events\OrderWasDelivered;
use App\ValueObjects\Address;
use App\ValueObjects\BookDetails;
use App\ValueObjects\BookID;
use App\ValueObjects\CustomerDetails;
use App\ValueObjects\CustomerID;
use App\ValueObjects\ID;
use Illuminate\Console\Command;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

final class Interact extends Command
{
    protected $signature = 'interact';

    protected $description = 'Interact with the aggregate';

    public function handle(): void
    {
        $address = new Address('street name', 'city name', 'state name', 'country name', '00010', 'ring name');
        $aggregate = Order::place(
            ID::fromUUID((string)Uuid::uuid4()),
            CustomerID::fromUUID((string)Uuid::uuid4()),
            new CustomerDetails('Damiano', 'Petrungaro', $address, $address),
            BookID::fromUUID('0fbbecd6-f71a-4c65-931c-1c6f361362f3'),
            new BookDetails('title', 'author', new Money(1000, new Currency('EUR')))
        );
        $aggregate->recordThat(new OrderWasDelivered(new \DateTimeImmutable()));
        $aggregate->persist();
    }
}
