<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckJobOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $jobId = $request->route('job') ?? $request->route('id');
        
        if ($jobId) {
            $job = \App\Models\Job::findOrFail($jobId);
            
            // Admin can access all jobs
            if ($user->isAdmin()) {
                return $next($request);
            }
            
            // Recruiter can only access their own jobs
            if ($user->isRecruiter() && $job->recruiter_id !== $user->id) {
                abort(403, 'Access denied. You can only access your own jobs.');
            }
            
            // Candidates cannot access job management
            if ($user->isCandidate()) {
                abort(403, 'Access denied. Candidates cannot manage jobs.');
            }
        }

        return $next($request);
    }
}
