<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApplicationOwnership
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
        $applicationId = $request->route('application') ?? $request->route('id');
        
        if ($applicationId) {
            $application = \App\Models\Application::findOrFail($applicationId);
            
            // Admin can access all applications
            if ($user->isAdmin()) {
                return $next($request);
            }
            
            // Recruiter can access applications for their jobs
            if ($user->isRecruiter() && $application->job->recruiter_id !== $user->id) {
                abort(403, 'Access denied. You can only access applications for your jobs.');
            }
            
            // Candidate can only access their own applications
            if ($user->isCandidate() && $application->candidate_id !== $user->id) {
                abort(403, 'Access denied. You can only access your own applications.');
            }
        }

        return $next($request);
    }
}
