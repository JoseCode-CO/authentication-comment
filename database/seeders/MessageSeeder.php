<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::create([
            'post_id' => 1,
            'sender_id' => 1,
            'receiver_id' => 2,
            'message' => "Hola me interesa"
        ]);

        Message::create([
            'post_id' => 1,
            'sender_id' => 2,
            'receiver_id' => 1,
            'message' => "Llamame"
        ]);
    }
}
