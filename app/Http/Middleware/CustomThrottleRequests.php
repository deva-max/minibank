<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CustomThrottleRequests
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next, $maxAttempts = 3, $decayMinutes = 5): Response
    {

        // if (env('RATE_LIMIT_ENABLED', true)) {
            $key = $this->resolveRequestKey($request);

            // Log some information for debugging
            Log::info('Request Key: ' . $key);
            Log::info('Max Attempts: ' . $maxAttempts);

            // Check if the user is locked out
            if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
                $lockoutTime = $this->limiter->availableIn($key);

                Log::info('Lockout Time: ' . $lockoutTime);

                return response()->json(['message' => 'Account is temporarily locked. Please try again in ' . $lockoutTime . ' seconds.'], 429);
        
            }

            $response = $next($request);

            // Check if the login attempt was unsuccessful
            
            if (!Auth::check()) {
                Log:info('Rate limiting middleware executed.');
                $this->limiter->hit($key, $decayMinutes * 60);
            }

            return $response;
        }
    // }

    protected function resolveRequestKey(Request $request)
    {
        // Check if there is a named route
        if ($request->route() && $request->route()->getName()) {
            return sha1($request->ip() . '|' . $request->route()->getName());
        } else {
            // If no named route exists, use a default key
            return sha1($request->ip() . '|default_key');
        }
    }


}
