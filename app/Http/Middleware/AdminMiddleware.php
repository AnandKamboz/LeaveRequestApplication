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
            $group =  RoleType::where('user_id', Auth::user()->id)->get();
            $roleIds = RoleType::where('user_id', Auth::user()->id)->pluck('role_id')->toArray();

              if (in_array(1, $roleIds) && in_array(2, $roleIds)) {
                return $next($request);
              }else{
                Auth::logout();
                return redirect('login');
              }
        } 

    }
}
