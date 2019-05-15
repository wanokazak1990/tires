<?php

namespace App\Http\Middleware;

use Closure;
use SiteInfo;

class ContentInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        SiteInfo::checkInfo();
        return $next($request);
    }
}
