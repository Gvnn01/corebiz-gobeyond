<?php

namespace App\Http\Middleware;

use App\Services\RedisService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class CacheMiddleware
{
    use RedisService;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cache = $this->getCacheById('challenge');
        if (isset($cache)) {
            return $next($request);
        } else {
            if (is_array($cache)) {
                if ($cache['status'] === 404) {
                    return $next($request);
                } else {
                    $r = $cache;
                }
            } else {
                $r = json_decode($cache, true);
            }
            return Response(
                [
                    'status' => 200,
                    'msg' => $r,
            ],
                200
            );
        }
    }
}
