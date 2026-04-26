<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        $query = Report::with(['reportedUser', 'reporterUser']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('reportedUser', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhere('reason', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reports = $query->orderBy('created_at', 'desc')->paginate(3);

        // Get statistics
        $stats = [
            'total' => Report::count(),
            'pending' => Report::pending()->count(),
            'reviewed' => Report::reviewed()->count(),
            'resolved' => Report::resolved()->count(),
            'dismissed' => Report::dismissed()->count()
        ];

        return view('dashboard.admin.reports', compact('reports', 'stats'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:dismiss,warn,suspend,delete',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $report = Report::findOrFail($id);
        
        $actionDescriptions = [
            'dismiss' => 'Signalement rejeté',
            'warn' => 'Avertissement envoyé',
            'suspend' => 'Compte suspendu',
            'delete' => 'Compte supprimé'
        ];

        $statusMap = [
            'dismiss' => 'dismissed',
            'warn' => 'reviewed',
            'suspend' => 'resolved',
            'delete' => 'resolved'
        ];

        $report->update([
            'status' => $statusMap[$request->action],
            'action_taken' => $actionDescriptions[$request->action],
            'action_taken_at' => now(),
            'admin_notes' => $request->admin_notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Action effectuée avec succès'
        ]);
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 1) {
            return response()->json([]);
        }

        $suggestions = [];

        // Search for ALL users (not just those in reports)
        $users = \App\Models\User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->limit(8)
            ->get();

        // Add user suggestions
        foreach ($users as $user) {
            $suggestions[] = [
                'type' => 'user',
                'text' => $user->name,
                'subtext' => $user->email . ' (' . ucfirst($user->user_type) . ')',
                'value' => $user->name
            ];
        }

        // Search for reasons only if we have space for more suggestions
        if (count($suggestions) < 5) {
            $reasons = \App\Models\Report::where('reason', 'like', "%{$query}%")
                ->distinct()
                ->limit(3)
                ->pluck('reason');

            // Add reason suggestions
            foreach ($reasons as $reason) {
                $suggestions[] = [
                    'type' => 'reason',
                    'text' => $reason,
                    'subtext' => 'Motif de signalement',
                    'value' => $reason
                ];
            }
        }

        return response()->json($suggestions);
    }

    public function export(Request $request)
    {
        $query = Report::with(['reportedUser', 'reporterUser']);

        // Apply same filters as index method
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('reportedUser', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhere('reason', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reports = $query->orderBy('created_at', 'desc')->get();

        $filename = 'signalements_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($reports) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // CSV Headers
            fputcsv($file, [
                'ID',
                'Utilisateur Signalé',
                'Email Utilisateur Signalé',
                'Type Utilisateur Signalé',
                'Signalé par',
                'Email Signaleur',
                'Type Signaleur',
                'Motif',
                'Description',
                'Statut',
                'Action Prise',
                'Notes Admin',
                'Date Action',
                'Date Création'
            ]);

            foreach ($reports as $report) {
                fputcsv($file, [
                    $report->id,
                    $report->reportedUser->name,
                    $report->reportedUser->email,
                    ucfirst($report->reportedUser->user_type),
                    $report->reporterUser->name,
                    $report->reporterUser->email,
                    ucfirst($report->reporterUser->user_type),
                    $report->reason,
                    $report->description,
                    $this->getStatusLabel($report->status),
                    $report->action_taken ?? '',
                    $report->admin_notes ?? '',
                    $report->action_taken_at ? $report->action_taken_at->format('d/m/Y H:i') : '',
                    $report->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getStatusLabel($status)
    {
        $labels = [
            'pending' => 'En attente',
            'reviewed' => 'En cours',
            'resolved' => 'Résolu',
            'dismissed' => 'Rejeté'
        ];

        return $labels[$status] ?? $status;
    }
}
