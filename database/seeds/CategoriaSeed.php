<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre' => 'Hotel',
            'slug' => 'Hotel',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Gimnasio',
            'slug' => 'Gimnasio',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Bar',
            'slug' => 'Bar',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Restaurante',
            'slug' => 'Restaurante',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Cafeteria',
            'slug' => 'Cafeteria',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
    }
}
