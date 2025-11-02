<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

    <title>Mes Candidatures - OMPLEO</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #00b6b4;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #00b6b4;
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        
        .header p {
            color: #666;
            margin: 0;
        }
        
        .user-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 18px;
            font-weight: bold;
            color: #00b6b4;
        }
        
        .stat-label {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }
        
        .applications-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .applications-table th,
        .applications-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        .applications-table th {
            background-color: #00b6b4;
            color: white;
            font-weight: bold;
        }
        
        .applications-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .status {
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-accepted {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-shortlisted {
            background-color: #cce5ff;
            color: #004085;
        }
        
        .status-reviewed {
            background-color: #e2e3e5;
            color: #383d41;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        .no-applications {
            text-align: center;
            color: #666;
            font-style: italic;
            margin: 40px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Mes Candidatures</h1>
        <p>Rapport généré le {{ now()->format('d/m/Y à H:i') }}</p>
    </div>
    
    <div class="user-info">
        <strong>Candidat:</strong> {{ $user->name }}<br>
        <strong>Email:</strong> {{ $user->email }}
    </div>
    
    <div class="stats">
        <div class="stat-item">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $stats['pending'] }}</div>
            <div class="stat-label">En cours</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $stats['accepted'] }}</div>
            <div class="stat-label">Acceptées</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $stats['rejected'] }}</div>
            <div class="stat-label">Refusées</div>
        </div>
    </div>
    
    @if($applications->count() > 0)
        <table class="applications-table">
            <thead>
                <tr>
                    <th>Poste</th>
                    <th>Entreprise</th>
                    <th>Localisation</th>
                    <th>Date de candidature</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                <tr>
                    <td>{{ $application->job->title }}</td>
                    <td>{{ $application->job->company->name }}</td>
                    <td>{{ $application->job->location }}</td>
                    <td>{{ $application->applied_at->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $statusMap = [
                                'pending' => ['text' => 'En cours', 'class' => 'status-pending'],
                                'accepted' => ['text' => 'Accepté', 'class' => 'status-accepted'],
                                'rejected' => ['text' => 'Refusé', 'class' => 'status-rejected'],
                                'shortlisted' => ['text' => 'Présélectionné', 'class' => 'status-shortlisted'],
                                'reviewed' => ['text' => 'Examiné', 'class' => 'status-reviewed']
                            ];
                            $statusInfo = $statusMap[$application->status] ?? ['text' => $application->status, 'class' => 'status-pending'];
                        @endphp
                        <span class="status {{ $statusInfo['class'] }}">{{ $statusInfo['text'] }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-applications">
            Aucune candidature trouvée.
        </div>
    @endif
    
    <div class="footer">
        <p>Généré par OMPLEO - Plateforme de Recrutement</p>
        <p>www.ompleo.com</p>
    </div>
</body>
</html>
