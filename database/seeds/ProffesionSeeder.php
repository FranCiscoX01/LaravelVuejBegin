<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProffesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\CrudProffesion');

        foreach (range(1,10) as $index) {
            DB::table('crudproffesion')->insert([
                'name' => $faker->sentence(),
                'description' => $faker->sentence(),
                'content' => $faker->sentence(),
            ]);
        }
    }
}
