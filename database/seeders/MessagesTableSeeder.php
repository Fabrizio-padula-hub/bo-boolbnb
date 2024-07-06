<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            $newMessage = new Message();
            $newMessage->apartment_id = $faker->numberBetween(1, 40);
            $newMessage->name = $faker->firstName();
            $newMessage->email = $faker->email();
            $newMessage->text = $faker->text();
            $newMessage->save();
        }
    }
}
