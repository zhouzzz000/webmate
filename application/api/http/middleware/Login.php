<?php

namespace app\api\http\middleware;

use app\api\exception\TestException;

class Login
{
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
}
