<?php

namespace App\Http\Middleware;

use Closure;

class ad_checked
{
    public function handle($request, Closure $next)
    {
        $loginAdmin = session()->get('login_admin');

        if (isset($loginAdmin)) {
            if (count($loginAdmin)) {
                
                return $next($request);
            }
        } else {
            $request->session()->flush();
            return redirect('login');
        }        
    }
}
