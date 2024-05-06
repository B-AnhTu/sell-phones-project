<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user() || $request->user()->user_type != $role) {
            // Nếu người dùng không có quyền truy cập, bạn có thể redirect hoặc trả về lỗi 403
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
