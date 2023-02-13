<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'created_by' => 1,
            'title' => 'Venta de pc',
            'content' => 'Este pc esta en venta por se muy bueno'
        ]);

        Post::create([
            'created_by' => 2,
            'title' => 'Viaje a  Cartagena',
            'content' => 'Aprovecha de este excelente viaje con todo pago'
        ]);
    }
}
