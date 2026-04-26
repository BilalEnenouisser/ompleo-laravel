<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.user.type:recruiter');
    }

    /**
     * Display the subscription page for the recruiter.
     */
    public function index()
    {
        $user = Auth::user();
        $recruiterProfile = $user->recruiterProfile;
        $company = $recruiterProfile->company ?? null;

        // Get current active subscription
        $currentSubscription = Subscription::where('recruiter_id', $user->id)
            ->whereIn('status', ['active', 'pending'])
            ->orderBy('end_date', 'desc')
            ->first();

        // Get all subscriptions history
        $subscriptions = Subscription::where('recruiter_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.recruiter.subscription', compact('currentSubscription', 'subscriptions', 'company'));
    }
}
