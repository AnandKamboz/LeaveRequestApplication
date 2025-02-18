<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\RoleType;



class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
         if (!empty(Auth::user()->id)) {
            $group =  RoleType::where('user_id', Auth::user()->id)->first();
            if ($group->role_id == '2') {
                return $next($request);
            } else {
                Auth::logout();
                return redirect('login');
            }
        } 

    }
}
