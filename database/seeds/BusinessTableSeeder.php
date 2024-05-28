<?php

use App\Business;
use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
            'name'=> 'Nombre de la empresa.',
            'description'=> 'Descripción corta de la empresa.',
            'logo'=> 'logo.png',
            'email'=>'Ejemplo@gmail.com',
            'address'=>'8888 Cummings Vista Apt. 101, Susanbury, NY 95473',
            'cif'=>'L12356785',
        ]);
    }
}
