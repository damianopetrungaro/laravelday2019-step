<?php

declare(strict_types=1);

namespace App\Serializers;

use DateTimeImmutable;
use App\Events\OrderWasShipped;
use App\Serializers\Exception\EventIsInvalid;
use App\Serializers\Exception\UnableToSerialize;
use Spatie\EventSourcing\EventSerializers\EventSerializer;
use Spatie\EventSourcing\ShouldBeStored;
use Throwable;

final class OrderWasShippedSerializer implements EventSerializer
{
    private const TIME_FORMAT = 'Y-m-f H:i:s';

    /**
     * @param OrderWasShipped $event
     */
    public function serialize(ShouldBeStored $event): string
    {
        if (OrderWasShipped::class !== \get_class($event)) {
            throw new EventIsInvalid(OrderWasShipped::class, \get_class($event));
        }

        return \json_encode([
            'shippedAt' => $event->shippedAt()->format(self::TIME_FORMAT),
        ]);
    }

    public function deserialize(string $eventClass, string $json): ShouldBeStored
    {
        if (OrderWasShipped::class !== $eventClass) {
            throw new EventIsInvalid(OrderWasShipped::class, $eventClass);
        }

        $event = \json_decode($json, true);

        try {
            $shippedAt = DateTimeImmutable::createFromFormat(self::TIME_FORMAT, $event['shippedAt']);
        } catch (Throwable $e) {
            throw new UnableToSerialize($eventClass, $e);
        }

        return new OrderWasShipped($shippedAt);
    }
}
