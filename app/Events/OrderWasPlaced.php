<?php

declare(strict_types=1);

namespace App\Events;

use App\ValueObjects\BookDetails;
use App\ValueObjects\BookID;
use App\ValueObjects\CustomerDetails;
use App\ValueObjects\CustomerID;
use App\ValueObjects\ID;
use DateTimeImmutable;
use Spatie\EventSourcing\ShouldBeStored;

final class OrderWasPlaced implements ShouldBeStored
{
    /**
     * @var ID
     */
    private $ID;

    /**
     * @var CustomerID
     */
    private $customerID;

    /**
     * @var CustomerDetails
     */
    private $customerDetails;

    /**
     * @var BookID
     */
    private $bookID;

    /**
     * @var BookDetails
     */
    private $bookDetails;

    /**
     * @var DateTimeImmutable
     */
    private $placedAt;

    public function __construct(
        ID $ID,
        CustomerID $customerID,
        CustomerDetails $customerDetails,
        BookID $bookID,
        BookDetails $bookDetails,
        DateTimeImmutable $placedAt
    )
    {
        $this->ID = $ID;
        $this->customerID = $customerID;
        $this->customerDetails = $customerDetails;
        $this->bookID = $bookID;
        $this->bookDetails = $bookDetails;
        $this->placedAt = $placedAt;
    }

    public function ID(): ID
    {
        return $this->ID;
    }

    public function customerID(): CustomerID
    {
        return $this->customerID;
    }

    public function customerDetails(): CustomerDetails
    {
        return $this->customerDetails;
    }

    public function bookID(): BookID
    {
        return $this->bookID;
    }

    public function bookDetails(): BookDetails
    {
        return $this->bookDetails;
    }

    public function placedAt(): DateTimeImmutable
    {
        return $this->placedAt;
    }
}
