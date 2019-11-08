<?php

declare(strict_types=1);

namespace App\Serializers;

use App\Events\OrderWasPaid;
use App\Serializers\Exception\EventIsInvalid;
use App\Serializers\Exception\UnableToSerialize;
use DateTimeImmutable;
use Spatie\EventSourcing\EventSerializers\EventSerializer;
use Spatie\EventSourcing\ShouldBeStored;
use Throwable;

final class OrderWasPaidSerializer implements EventSerializer
{
    private const TIME_FORMAT = 'Y-m-f H:i:s';

    /**
     * @param OrderWasPaid $event
     */
    public function serialize(ShouldBeStored $event): string
    {
        if (OrderWasPaid::class !== \get_class($event)) {
            throw new EventIsInvalid(OrderWasPaid::class, \get_class($event));
        }

        return \json_encode([
            'paidAt' => $event->paidAt()->format(self::TIME_FORMAT),
        ]);
    }

    public function deserialize(string $eventClass, string $json): ShouldBeStored
    {
        if (OrderWasPaid::class !== $eventClass) {
            throw new EventIsInvalid(OrderWasPaid::class, $eventClass);
        }

        $event = \json_decode($json, true);

        try {
            $paidAt = DateTimeImmutable::createFromFormat(self::TIME_FORMAT, $event['paidAt']);
        } catch (Throwable $e) {
            throw new UnableToSerialize($eventClass, $e);
        }

        return new OrderWasPaid($paidAt);
    }
}
