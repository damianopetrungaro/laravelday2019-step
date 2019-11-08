<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use InvalidArgumentException;
use Money\Currency;
use Money\Money;
use App\Aggregates\Exception\OrderIsAlreadyShipped;
use App\Service\FindUserID;
use App\UseCases\MarkOrderAsRefunded as UseCase;
use App\ValueObjects\Exception\InvalidID;
use App\ValueObjects\ID;

class MarkOrderAsRefunded extends Command
{
    /**
     * @var string
     */
    protected $signature = 'order:refunded {id} {user_id} {amount} {currency}';

    /**
     * @var string
     */
    protected $description = 'Mark an order as refunded';

    /**
     * @var UseCase
     */
    private $useCase;

    /**
     * @var FindUserID
     */
    private $findUserID;

    public function __construct(UseCase $useCase, FindUserID $findUserID)
    {
        parent::__construct();
        $this->useCase = $useCase;
        $this->findUserID = $findUserID;
    }

    public function handle(): void
    {
        /** @var string $argumentID */
        $argumentID = $this->argument('id');
        /** @var string $argumentUserID */
        $argumentUserID = $this->argument('user_id');
        /** @var string $argumentAmount */
        $argumentAmount = $this->argument('amount');
        /** @var string $argumentCurrency */
        $argumentCurrency = $this->argument('currency');

        try {
            $id = ID::fromUUID($argumentID);
        } catch (InvalidID $e) {
            $this->output->error("parsing ID: {$e->getMessage()}");

            return;
        }

        try {
            $amount = new Money($argumentAmount, new Currency($argumentCurrency));
        } catch (InvalidArgumentException $e) {
            $this->output->warning($e->getMessage());

            return;
        }

        if (!$userID = ($this->findUserID)($argumentUserID)) {
            $this->output->error("user ID not found: {$argumentUserID}");

            return;
        }

        try {
            ($this->useCase)($id, $amount, $userID);
        } catch (OrderIsAlreadyShipped $e) {
            $this->output->warning($e->getMessage());

            return;
        } catch (\Throwable $e) {
            $this->output->error($e->getMessage());

            return;
        }

        $this->output->success('Order has been marked as refunded');
    }
}
