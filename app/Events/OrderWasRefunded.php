<?php

declare(strict_types=1);

namespace App\Events;

use App\ValueObjects\UserID;
use DateTimeImmutable;
use Money\Money;
use Spatie\EventSourcing\ShouldBeStored;

final class OrderWasRefunded implements ShouldBeStored
{
    /**
     * @var Money
     */
    private $amount;

    /**
     * @var UserID
     */
    private $refundedBy;

    /**
     * @var DateTimeImmutable
     */
    private $refundedAt;

    public function __construct(Money $amount, UserID $refundedBy, DateTimeImmutable $refundedAt)
    {
        $this->amount = $amount;
        $this->refundedBy = $refundedBy;
        $this->refundedAt = $refundedAt;
    }

    public function amount(): Money
    {
        return $this->amount;
    }

    public function refundedBy(): UserID
    {
        return $this->refundedBy;
    }

    public function refundedAt(): DateTimeImmutable
    {
        return $this->refundedAt;
    }
}
