<?php

declare(strict_types=1);

namespace App\Http\Middleware\Validation;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\ValueObjects\Exception\InvalidID;
use App\ValueObjects\ID;

final class IDValidation
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $request[ID::class] = ID::fromUUID($request->get('id', ''));
        } catch (InvalidID $e) {
            return new Response($e->getMessage(), 404);
        }

        return $next($request);
    }
}
