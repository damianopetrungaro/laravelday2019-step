<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UseCases\MarkOrderAsShipped as UseCase;
use App\ValueObjects\Exception\InvalidID;
use App\ValueObjects\ID;

class MarkOrderAsShipped extends Command
{
    /**
     * @var string
     */
    protected $signature = 'order:shipped {id}';

    /**
     * @var string
     */
    protected $description = 'Mark an order as shipped';

    /**
     * @var UseCase
     */
    private $useCase;

    public function __construct(UseCase $useCase)
    {
        parent::__construct();
        $this->useCase = $useCase;
    }

    public function handle(): void
    {
        /** @var string $argumentID */
        $argumentID = $this->argument('id');

        try {
            $id = ID::fromUUID($argumentID);
        } catch (InvalidID $e) {
            $this->output->error($e->getMessage());

            return;
        }

        try {
            ($this->useCase)($id);
        } catch (\Throwable $e) {
            $this->output->error($e->getMessage());

            return;
        }

        $this->output->success('Order has been marked as shipped');
    }
}
