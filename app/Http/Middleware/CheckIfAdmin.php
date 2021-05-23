<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        dd(Auth::user());
        // Если пользователь авторизован и является админом или модератором то пропускать дальше, иначе редирект на домашнюю страницу
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->isModerator()) {
            return $next($request);
        }

        return redirect('home');
//        return $next($request);
    }
}
