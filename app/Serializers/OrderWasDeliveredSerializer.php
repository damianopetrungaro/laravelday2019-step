<?php

declare(strict_types=1);

namespace App\Serializers;

use App\Events\OrderWasDelivered;
use App\Serializers\Exception\EventIsInvalid;
use App\Serializers\Exception\UnableToSerialize;
use DateTimeImmutable;
use Spatie\EventSourcing\EventSerializers\EventSerializer;
use Spatie\EventSourcing\ShouldBeStored;
use Throwable;

final class OrderWasDeliveredSerializer implements EventSerializer
{
    private const TIME_FORMAT = 'Y-m-f H:i:s';

    /**
     * @param OrderWasDelivered $event
     */
    public function serialize(ShouldBeStored $event): string
    {
        if (OrderWasDelivered::class !== \get_class($event)) {
            throw new EventIsInvalid(OrderWasDelivered::class, \get_class($event));
        }

        return \json_encode([
            'deliveredAt' => $event->deliveredAt()->format(self::TIME_FORMAT),
        ]);
    }

    public function deserialize(string $eventClass, string $json): ShouldBeStored
    {
        if (OrderWasDelivered::class !== $eventClass) {
            throw new EventIsInvalid(OrderWasDelivered::class, $eventClass);
        }

        $event = \json_decode($json, true);

        try {
            $deliveredAt = DateTimeImmutable::createFromFormat(self::TIME_FORMAT, $event['deliveredAt']);
        } catch (Throwable $e) {
            throw new UnableToSerialize($eventClass, $e);
        }

        return new OrderWasDelivered($deliveredAt);
    }
}
