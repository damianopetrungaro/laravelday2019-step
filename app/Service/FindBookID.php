<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Book;
use App\ValueObjects\BookID;

final class FindBookID
{
    public function __invoke(string $id): ?BookID
    {
        if (!$book = Book::find($id)) {
            return null;
        }

        try {
            return BookID::fromUUID($book['id']);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
