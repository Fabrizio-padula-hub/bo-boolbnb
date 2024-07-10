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
        $messages = config('message');
        for ($i = 0; $i < 200; $i++) {
            foreach ($messages as $message) {
                $newMessage = new Message();
                $newMessage->apartment_id = $faker->numberBetween(1, 130);
                $newMessage->name = $faker->name();
                $newMessage->email = $newMessage->name . '@mail.it';
                $newMessage->text = $message['text'];
                $newMessage->save();
            }
        }
    }
}
