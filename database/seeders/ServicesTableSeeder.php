<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $services = ['WiFi', 'Posto Macchina', 'Piscina', 'Portineria', 'Sauna', 'Vista Mare', 'Lavatrice', 'Animali', 'Cucina', 'Lavastoviglie'];

        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service;
            $newService->image = 'https://via.placeholder.com/640x480.png/004466?text=animals+omnis';
            $newService->save();
        }
    }
}
