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
        for ($i = 0; $i < 2; $i++) {
            foreach ($messages as $message) {
                $newMessage = new Message();
                $newMessage->apartment_id = $faker->numberBetween(1, 20);
                $newMessage->name = $faker->name();
                $formattedName = $this->formatName($newMessage->name);
                $newMessage->email = $formattedName . '@mail.it';
                $newMessage->text = $message['text'];
                $newMessage->save();
            }
        }
    }

    function formatName($fullName)
    {
        $lowerCaseName = strtolower($fullName);
        $formattedName = str_replace(' ', '.', $lowerCaseName);

        return $formattedName;
    }
}
