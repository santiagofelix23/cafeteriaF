<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Tacos al pastor',
                'precio' => 55,
                'imagen' => 'tacos_pastor.jpg'
            ],
            [
                'nombre' => 'Enchiladas verdes de pollo',
                'precio' => 70,
                'imagen' => 'enchiladas_verdes.webp'
            ],
            [
                'nombre' => 'Chiles en nogada',
                'precio' => 90,
                'imagen' => 'chiles_nogada.jpeg'
            ],
            [
                'nombre' => 'Pozole rojo',
                'precio' => 65,
                'imagen' => 'pozole_rojo.jpg'
            ],
            [
                'nombre' => 'Tamales de elote',
                'precio' => 45,
                'imagen' => 'tamal_elote.jpg'
            ],
            [
                'nombre' => 'Sopes con carne',
                'precio' => 50,
                'imagen' => 'sopes_carne.jpg'
            ],
            [
                'nombre' => 'Quesadillas de flor',
                'precio' => 40,
                'imagen' => 'quesadillas_flor.jpeg'
            ],
            [
                'nombre' => 'Tortas ahogadas',
                'precio' => 60,
                'imagen' => 'tortas_ahogadas.jpg'
            ],
            [
                'nombre' => 'Mole poblano con arroz',
                'precio' => 80,
                'imagen' => 'mole_poblano.jpg'
            ],
            [
                'nombre' => 'Tlacoyos de frijol',
                'precio' => 35,
                'imagen' => 'tlacoyos_frijol.jpg'
            ],
        ]);
    }
}
