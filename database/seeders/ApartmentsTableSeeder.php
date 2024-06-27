<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Apartment;
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
        for ($i = 0; $i < 10; $i++) {
            $newApartment = new Apartment();
            $newApartment->title = $faker->unique()->word();
            $newApartment->slug = Str::slug($newApartment->title, '-');
            while (Apartment::where('slug', $newApartment->slug)->exists()) {
                $newApartment->slug = $newApartment->slug . '-' . $counter;
                $counter++;
            }
            $newApartment->description = $faker->text(200);
            $newApartment->number_of_room = $faker->randomDigit();
            $newApartment->number_of_beds = $faker->randomDigit();
            $newApartment->number_of_bathrooms = $faker->randomDigit();
            $newApartment->square_meters = $faker->randomFloat(1, 20, 30);
            $newApartment->street_name = $faker->streetName();
            $newApartment->street_number = $faker->buildingNumber();
            $newApartment->city = 'Roma';
            $newApartment->country_code = 'IT';
            $newApartment->postal_code = '00118';
            $newApartment->lat = $faker->latitude($min = -90, $max = 90);
            $newApartment->long = $faker->longitude($min = -180, $max = 180);
            $newApartment->visibility = $faker->boolean();
            $newApartment->save();
        }
    }
}
