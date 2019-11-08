<?php

declare(strict_types=1);

namespace App\UseCases;

use Money\Money;
use App\Repository\OrderRepository;
use App\ValueObjects\ID;
use App\ValueObjects\UserID;

final class RefundOrder
{
    /**
     * @var OrderRepository
     */
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ID $ID, Money $amount, UserID $userID): void
    {
        $order = $this->repository->getByID($ID);
        $order->refund($amount, $userID);
        $this->repository->add($order);
    }
}
