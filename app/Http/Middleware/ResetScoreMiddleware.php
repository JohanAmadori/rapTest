<?php

namespace App\Http\Middleware;

use Closure;

class ResetScoreMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!session('quiz_completed')) {
            session(['score' => 0, 'answered_questions' => []]);
        }

        return $next($request);
    }
}
