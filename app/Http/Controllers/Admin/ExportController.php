<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Company;
use App\Models\Blog;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    /**
     * Export platform statistics
     */
    public function stats(Request $request)
    {
        $format = $request->get('format', 'excel');
        
        // Get statistics data
        $stats = [
            'users' => [
                'total' => User::count(),
                'candidates' => User::where('user_type', 'candidate')->count(),
                'recruiters' => User::where('user_type', 'recruiter')->count(),
                'admins' => User::where('user_type', 'admin')->count(),
                'this_month' => User::whereMonth('created_at', now()->month)->count(),
            ],
            'jobs' => [
                'total' => Job::count(),
                'published' => Job::where('status', 'published')->count(),
                'draft' => Job::where('status', 'draft')->count(),
                'this_week' => Job::where('created_at', '>=', now()->subWeek())->count(),
            ],
            'companies' => [
                'total' => Company::count(),
                'active' => Company::where('is_active', true)->count(),
            ],
            'blogs' => [
                'total' => Blog::count(),
                'published' => Blog::where('status', 'published')->count(),
                'draft' => Blog::where('status', 'draft')->count(),
            ],
            'applications' => [
                'total' => Application::count(),
                'pending' => Application::where('status', 'pending')->count(),
                'accepted' => Application::where('status', 'accepted')->count(),
                'rejected' => Application::where('status', 'rejected')->count(),
                'this_month' => Application::whereMonth('created_at', now()->month)->count(),
            ],
            'revenue' => [
                'total' => Application::count() * 50, // 50 DA per application
                'this_month' => Application::whereMonth('created_at', now()->month)->count() * 50,
            ]
        ];
        
        if ($format === 'pdf') {
            return $this->exportToPdf($stats);
        } else {
            return $this->exportToExcel($stats);
        }
    }
    
    /**
     * Export to Excel format
     */
    private function exportToExcel($stats)
    {
        $filename = 'stats_ompleo_' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($stats) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Headers
            fputcsv($file, ['Statistiques OMPLEO - ' . now()->format('d/m/Y')]);
            fputcsv($file, []);
            
            // Users section
            fputcsv($file, ['UTILISATEURS']);
            fputcsv($file, ['Total utilisateurs', $stats['users']['total']]);
            fputcsv($file, ['Candidats', $stats['users']['candidates']]);
            fputcsv($file, ['Recruteurs', $stats['users']['recruiters']]);
            fputcsv($file, ['Administrateurs', $stats['users']['admins']]);
            fputcsv($file, ['Nouveaux ce mois', $stats['users']['this_month']]);
            fputcsv($file, []);
            
            // Jobs section
            fputcsv($file, ['OFFRES D\'EMPLOI']);
            fputcsv($file, ['Total offres', $stats['jobs']['total']]);
            fputcsv($file, ['Publiées', $stats['jobs']['published']]);
            fputcsv($file, ['Brouillons', $stats['jobs']['draft']]);
            fputcsv($file, ['Cette semaine', $stats['jobs']['this_week']]);
            fputcsv($file, []);
            
            // Companies section
            fputcsv($file, ['ENTREPRISES']);
            fputcsv($file, ['Total entreprises', $stats['companies']['total']]);
            fputcsv($file, ['Actives', $stats['companies']['active']]);
            fputcsv($file, []);
            
            // Blogs section
            fputcsv($file, ['BLOG']);
            fputcsv($file, ['Total articles', $stats['blogs']['total']]);
            fputcsv($file, ['Publiés', $stats['blogs']['published']]);
            fputcsv($file, ['Brouillons', $stats['blogs']['draft']]);
            fputcsv($file, []);
            
            // Applications section
            fputcsv($file, ['CANDIDATURES']);
            fputcsv($file, ['Total candidatures', $stats['applications']['total']]);
            fputcsv($file, ['En attente', $stats['applications']['pending']]);
            fputcsv($file, ['Acceptées', $stats['applications']['accepted']]);
            fputcsv($file, ['Rejetées', $stats['applications']['rejected']]);
            fputcsv($file, ['Ce mois', $stats['applications']['this_month']]);
            fputcsv($file, []);
            
            // Revenue section
            fputcsv($file, ['REVENUS']);
            fputcsv($file, ['Total revenus (DA)', $stats['revenue']['total']]);
            fputcsv($file, ['Ce mois (DA)', $stats['revenue']['this_month']]);
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Export to PDF format
     */
    private function exportToPdf($stats)
    {
        $filename = 'stats_ompleo_' . now()->format('Y-m-d') . '.pdf';
        
        // For now, return a simple HTML response that can be printed as PDF
        $html = view('dashboard.admin.export-pdf', compact('stats'))->render();
        
        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }
}