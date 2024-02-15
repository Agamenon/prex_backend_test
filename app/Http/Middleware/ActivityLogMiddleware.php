<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var JsonResponse $response */
        $response = $next($request);

        $user = Auth::user();
        $action = $request->route()->getAction()['as'];
        $input = $request->input();

        activity()
            ->causedBy($user)
            ->event($action)
            ->withProperties(['input' => $input, 'response' => $response->getData(), 'ip' => $request->server("REMOTE_ADDR")])
            ->log("The User " . $user->name . " do " . $action);

        return $response;
    }
}
