<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;

    public function getKeyType(): string
    {
        return 'string';
    }
}
