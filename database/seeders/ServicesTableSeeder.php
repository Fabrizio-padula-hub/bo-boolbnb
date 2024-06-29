<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $services = config('service');
        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service['name'];
            $newService->image = $service['image'];
            $newService->save();
        }
    }
}
