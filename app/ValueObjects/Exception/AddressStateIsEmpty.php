<?php

declare(strict_types=1);

namespace App\ValueObjects\Exception;

use InvalidArgumentException;
use Throwable;

final class AddressStateIsEmpty extends InvalidArgumentException
{
    private const ERROR_MESSAGE = "The state can't be empty.";

    public function __construct(Throwable $previous = null)
    {
        parent::__construct(self::ERROR_MESSAGE, $code = 0, $previous);
    }
}
