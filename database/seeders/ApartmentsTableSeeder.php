<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker = \Faker\Factory::create('it_IT');
        $counter = 1;
        $apartments = config('apartment');
        for ($i = 0; $i < 10; $i++) {
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
                $newApartment->number_of_rooms = $faker->randomDigit();
                $newApartment->number_of_beds = $faker->randomDigit();
                $newApartment->number_of_bathrooms = $faker->randomDigit();
                $newApartment->square_meters = $faker->randomFloat(1, 20, 30);
                $newApartment->visibility = $faker->boolean();
                $newApartment->save();
            }
        }
    }
}
