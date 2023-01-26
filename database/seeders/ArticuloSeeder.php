<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articulos')->insert([
            'codigo' => '1',
            'objeto' => 'pelotas',
            'descripcion' => 'de futbol',
            'fecha' => '1-12-12',
            'cantidad' => '10',
            'total' => '10'
        ]);
        DB::table('articulos')->insert([
            'codigo' => '2',
            'objeto' => 'gorras',
            'descripcion' => 'baseball',
            'fecha' => '1-12-12',
            'cantidad' => '10',
            'total' => '10'
        ]);
        DB::table('articulos')->insert([
            'codigo' => '3',
            'objeto' => 'redes',
            'descripcion' => 'porterias de futbol',
            'fecha' => '1-12-12',
            'cantidad' => '10',
            'total' => '10'
        ]);
        DB::table('articulos')->insert([
            'codigo' => '4',
            'objeto' => 'bates de madera',
            'descripcion' => 'baseball',
            'fecha' => '1-12-12',
            'cantidad' => '10',
            'total' => '10'
        ]);
    }
}
