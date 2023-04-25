<?php

namespace App\Http\Middleware;

use App\Models\Post;
use App\Models\Team;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCurrentTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user() || $team = Team::where('domain', $request->route()->parameter('blog'))->first()) {

            Post::addGlobalScope(function ($query) use ($request): void {
                $query->where('team_id', $request->user()->currentTeam->id);
            });
        }

        return $next($request);
    }
}
