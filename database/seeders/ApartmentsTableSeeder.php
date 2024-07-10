<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Sponsorship;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $counter = 1;
        $apartments = config('apartment');
        for ($i = 0; $i < 1; $i++) {
            foreach ($apartments as $apartment) {
                $newApartment = new Apartment();
                $newApartment->user_id = $faker->numberBetween(1, 6);
                $newApartment->title = $apartment['title'];
                $newApartment->slug = Str::slug($newApartment->title, '-');
                while (Apartment::where('slug', $newApartment->slug)->exists()) {
                    $newApartment->slug = $newApartment->slug . '-' . $counter;
                    $counter++;
                }
                $newApartment->description = $apartment['description'];
                $newApartment->address = $apartment['address'];
                $newApartment->lat = $apartment['lat'];
                $newApartment->long = $apartment['long'];
                $newApartment->number_of_rooms = $faker->numberBetween(1, 3);
                $newApartment->number_of_beds = $newApartment->number_of_rooms;
                $newApartment->square_meters = $faker->numberBetween(15, 120);
                if ($newApartment->square_meters > 80) {
                    $newApartment->number_of_bathrooms = $faker->numberBetween(1, 2);
                } else {
                    $newApartment->number_of_bathrooms = $faker->numberBetween(1, 2);
                }
                $newApartment->visibility = $faker->boolean();
                $newApartment->save();

                $services = Service::inRandomOrder()->limit(3)->get();
                $newApartment->services()->attach($services);
            }
        }
    }
}
