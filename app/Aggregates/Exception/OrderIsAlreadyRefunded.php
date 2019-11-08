<?php

declare(strict_types=1);

namespace App\Aggregates\Exception;

use App\ValueObjects\ID;
use DomainException;
use Throwable;

final class OrderIsAlreadyRefunded extends DomainException
{
    private const ERROR_MESSAGE_FORMAT = 'The order with ID "%s" is already refunded.';

    public function __construct(ID $ID, Throwable $previous = null)
    {
        $message = \sprintf(self::ERROR_MESSAGE_FORMAT, (string)$ID);
        parent::__construct($message, $code = 0, $previous);
    }
}
