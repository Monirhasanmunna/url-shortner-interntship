<?php

namespace App\Http\Middleware;

use App\Models\Configuration;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SpamDetectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $config = Configuration::first();
        $ip = $request->ip();
        $url = $request->fullUrl();
        $key = "click_count:$ip:$url";
        
        // Increment the click count for the current IP
        $clickCount = Cache::get($key, 0);
        $clickCount++;
        Log::info("Updated Click Count: $clickCount");

        // Store the incremented click count in cache for 1 minute
        Cache::put($key, $clickCount, now()->addMinutes(1));

        // Check if the click count exceeds the limit
        $limit = $config->click_limit;
        $blockDuration = $config->block_duration; // in minutes

        if($clickCount > $limit){
            // Block the IP by storing a flag in cache
            Cache::put("block_ip:$ip:$url", true, $blockDuration);

            // Return a response indicating that the IP is blocked
            return response('You have been blocked for exceeding the click limit.', 403);
        }


        // Check if the IP is blocked
        if (Cache::get("blocked_ip:$ip:$url")) {
            // Return a response indicating that the IP is blocked
            return response('You have been blocked for exceeding the click limit.', 403);
        }

        // If the IP is not blocked, allow the request to proceed
        return $next($request);
    }
}
