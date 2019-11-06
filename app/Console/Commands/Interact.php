<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\OrderWasDelivered;
use Spatie\EventSourcing\AggregateRoot;

final class Interact extends Command
{
    protected $signature = 'interact';

    protected $description = 'Interact with the aggregate';

    public function handle(): void
    {
        $aggregate = $this->anonymousClass();
        $aggregate->recordThat(new OrderWasDelivered(new \DateTimeImmutable()));
        $aggregate->persist();
    }

    public function handle2(): void
    {
        // Let's make the attributes public and no constructor, so we can save the object
        $aggregate = $this->anonymousClass();
        $event = new OrderWasDelivered();
        $event->deliveredAt = new \DateTimeImmutable();
        $aggregate->recordThat($event);
        $aggregate->persist();
    }

    private function anonymousClass(): AggregateRoot
    {
        return new class extends AggregateRoot
        {
        };
    }
}
