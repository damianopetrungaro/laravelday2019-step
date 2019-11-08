<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\User;
use App\ValueObjects\UserID;

final class FindUserID
{
    public function __invoke(string $id): ?UserID
    {
        if (!$user = User::find($id)) {
            return null;
        }

        try {
            return UserID::fromUUID($user['id']);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
