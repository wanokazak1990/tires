<?php

namespace App\Http\Middleware;

use Closure;
use Session;

use App\visit;

class visitcounter
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
        if(!Session::has('userSession'))
        {
            Session::put('userSession',true);
            $visit = visit::whereDate('created_at',date('Y-m-d'))->first();
            if(isset($visit->id))
            {
                $visit->count+=1;
                $visit->update();
            }
            else
                visit::create([
                    'count'=>1
                ]);
        }
        return $next($request);
    }
}
