<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Visit;
use Carbon\Carbon;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();

        for ($i = 0; $i < 30; $i++) {
            $newVisit = new Visit();
            $newVisit->apartment_id = $faker->numberBetween(1, 20);
            $newVisit->ip_address = $this->getRandomIP();
            $newVisit->visited_at = $faker->dateTimeBetween($startDate, $endDate);
            $newVisit->save();
        }
    }

    function getRandomIP()
    {
        $octet1 = rand(0, 255);
        $octet2 = rand(0, 255);
        $octet3 = rand(0, 255);
        $octet4 = rand(0, 255);

        return "$octet1.$octet2.$octet3.$octet4";
    }
}
