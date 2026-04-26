<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all published jobs
        $jobs = Job::where('status', 'published')->get();
        
        // Get candidate users
        $candidates = User::where('user_type', 'candidate')->get();
        
        if ($jobs->isEmpty() || $candidates->isEmpty()) {
            $this->command->info('No jobs or candidates found. Skipping application seeding.');
            return;
        }
        
        $statuses = ['pending', 'accepted', 'rejected'];
        $coverLetters = [
            'Je suis très intéressé par ce poste et je pense avoir les compétences nécessaires pour réussir dans ce rôle.',
            'Avec mon expérience dans le domaine, je suis convaincu que je peux apporter une valeur ajoutée à votre équipe.',
            'Ce poste correspond parfaitement à mes aspirations professionnelles et à mes compétences.',
            'Je suis passionné par ce domaine et j\'aimerais contribuer au succès de votre entreprise.',
            'Mon parcours professionnel et mes compétences techniques me permettent de bien répondre aux exigences de ce poste.'
        ];
        
        // Create applications for each job
        foreach ($jobs as $job) {
            // Random number of applications per job (1-8)
            $numApplications = rand(1, 8);
            
            for ($i = 0; $i < $numApplications; $i++) {
                $candidate = $candidates->random();
                $status = $statuses[array_rand($statuses)];
                $coverLetter = $coverLetters[array_rand($coverLetters)];
                
                // Random application date (within last 3 months)
                $appliedAt = now()->subDays(rand(0, 90));
                
                Application::create([
                    'job_id' => $job->id,
                    'candidate_id' => $candidate->id,
                    'cover_letter' => $coverLetter,
                    'resume_path' => 'resumes/cv_' . $candidate->id . '.pdf',
                    'status' => $status,
                    'applied_at' => $appliedAt,
                    'reviewed_at' => $status !== 'pending' ? $appliedAt->addDays(rand(1, 7)) : null,
                ]);
            }
        }
        
        $this->command->info('Applications created successfully!');
    }
}
