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
    public function run(Faker $faker )
    {
        $faker = \Faker\Factory::create('it_IT');
        for($i = 0; $i < 10; $i++){
            $newApartment = new Apartment();
            $newApartment->title = $faker->unique()->word();
            $newApartment->slug = Str::slug($newApartment->title,'-');
            $newApartment->number_of_room = $faker->randomDigit();
            $newApartment->number_of_beds = $faker->randomDigit();
            $newApartment->number_of_bathrooms = $faker->randomDigit();
            $newApartment->square_meters = $faker->randomFloat(1, 20, 30);
            $newApartment->address = $faker->address() ;
            $newApartment->lat = $faker->latitude($min = -90, $max = 90);
            $newApartment->long = $faker->longitude($min = -180, $max = 180);
            $newApartment->visibility = $faker->boolean();
            $newApartment->save();
        }
    }
}
