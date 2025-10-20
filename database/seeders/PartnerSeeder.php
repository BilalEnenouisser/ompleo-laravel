<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Air Algérie',
                'logo' => 'partners/air-algerie.png',
                'website' => 'https://www.airalgerie.dz',
                'description' => 'Compagnie aérienne nationale algérienne',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Algérie Télécom',
                'logo' => 'partners/algerie-telecom.png',
                'website' => 'https://www.algerietelecom.dz',
                'description' => 'Opérateur de télécommunications algérien',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Mobilis',
                'logo' => 'partners/mobilis.png',
                'website' => 'https://www.mobilis.dz',
                'description' => 'Opérateur mobile algérien',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Sonelgaz',
                'logo' => 'partners/sonelgaz.png',
                'website' => 'https://www.sonelgaz.dz',
                'description' => 'Entreprise nationale de l\'électricité et du gaz',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Djezzy',
                'logo' => 'partners/djezzy.png',
                'website' => 'https://www.djezzy.dz',
                'description' => 'Opérateur mobile algérien',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Ooredoo',
                'logo' => 'partners/ooredoo.png',
                'website' => 'https://www.ooredoo.dz',
                'description' => 'Opérateur mobile algérien',
                'is_featured' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'BNA',
                'logo' => 'partners/bna.png',
                'website' => 'https://www.bna.dz',
                'description' => 'Banque Nationale d\'Algérie',
                'is_featured' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Cevital',
                'logo' => 'partners/cevital.png',
                'website' => 'https://www.cevital.com',
                'description' => 'Groupe industriel algérien',
                'is_featured' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'ENTP',
                'logo' => 'partners/entp.png',
                'website' => 'https://www.entp.dz',
                'description' => 'Entreprise Nationale des Travaux Publics',
                'is_featured' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Benamor',
                'logo' => 'partners/benamor.png',
                'website' => 'https://www.benamor.dz',
                'description' => 'Groupe Benamor',
                'is_featured' => true,
                'sort_order' => 10,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }

        $this->command->info('Partners created successfully!');
    }
}
