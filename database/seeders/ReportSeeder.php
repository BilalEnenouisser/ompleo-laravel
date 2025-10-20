<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users to create reports
        $users = User::take(10)->get();
        
        if ($users->count() < 2) {
            $this->command->info('Not enough users to create reports. Please create some users first.');
            return;
        }

        $reasons = [
            'Faux profil',
            'Contenu inapproprié',
            'Spam',
            'Harcèlement',
            'Informations frauduleuses'
        ];

        $descriptions = [
            'Les informations du profil semblent fictives, pas de cohérence dans l\'expérience.',
            'Photo de profil non professionnelle et commentaires déplacés.',
            'Envoi de messages répétitifs et non sollicités.',
            'Comportement inapproprié envers d\'autres utilisateurs.',
            'Fausses informations de contact et d\'entreprise.'
        ];

        $statuses = ['pending', 'reviewed', 'resolved', 'dismissed'];

        // Create 15 sample reports
        for ($i = 0; $i < 15; $i++) {
            $reportedUser = $users->random();
            $reporterUser = $users->where('id', '!=', $reportedUser->id)->random();
            
            Report::create([
                'reported_user_id' => $reportedUser->id,
                'reporter_user_id' => $reporterUser->id,
                'reason' => $reasons[array_rand($reasons)],
                'description' => $descriptions[array_rand($descriptions)],
                'status' => $statuses[array_rand($statuses)],
                'admin_notes' => $i % 3 === 0 ? 'Action en cours de traitement' : null,
                'action_taken' => $i % 4 === 0 ? 'Avertissement envoyé' : null,
                'action_taken_at' => $i % 4 === 0 ? now()->subDays(rand(1, 7)) : null,
                'created_at' => now()->subDays(rand(1, 30))
            ]);
        }
    }
}
