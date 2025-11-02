<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.user.type:admin');
    }

    /**
     * Display the payments management page.
     */
    public function index(Request $request)
    {
        $query = Subscription::with(['recruiter', 'company']);

        // Search filter
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('transaction_id', 'like', '%' . $search . '%')
                  ->orWhereHas('recruiter', function($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('company', function($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Status filter
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Payment method filter
        if ($request->has('method') && $request->method !== '') {
            $query->where('payment_method', $request->method);
        }

        $subscriptions = $query->orderBy('created_at', 'desc')->paginate(20);

        // Calculate stats
        $stats = [
            'total_revenue' => Subscription::where('status', 'active')->sum('amount'),
            'total_transactions' => Subscription::count(),
            'completed' => Subscription::where('status', 'active')->count(),
            'pending' => Subscription::where('status', 'pending')->count(),
            'expired' => Subscription::where('status', 'expired')->orWhere('status', 'cancelled')->count(),
        ];

        return view('dashboard.admin.payments', compact('subscriptions', 'stats'));
    }
}
