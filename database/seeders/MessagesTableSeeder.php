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
        $faker = \Faker\Factory::create('it_IT');
        for ($i = 0; $i < 10; $i++) {
            $newMessages = new Message();
            $newMessages->name = $faker->firstName();
            $newMessages->email = $faker->email();
            $newMessages->text = $faker->text();
            $newMessages->save();
        }
    }
}
