<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Repository\OrderRepository;
use App\ValueObjects\ID;

final class MarkOrderAsDelivered
{
    /**
     * @var OrderRepository
     */
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ID $ID): void
    {
        $order = $this->repository->getByID($ID);
        $order->markAsDelivered();
        $this->repository->add($order);
    }
}
