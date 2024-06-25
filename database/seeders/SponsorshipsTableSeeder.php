<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Sponsorship;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $sponsorships = [
            [   
                'name' => 'Standard',
                'price' => 2.99,
                'duration' => 24
            ],
            [
                'name' => 'Economy', 
                'price' => 5.99,
                'duration' => 72
            ],
            [
                'name' => 'Premium', 
                'price' => 9.99,
                'duration' => 144
            ],
        ];

        foreach ($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->name = $sponsorship['name'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->duration = $sponsorship['duration'];
            $newSponsorship->save();
        }
        
        
    }
}
