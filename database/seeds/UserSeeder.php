<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i <10; $i++) {
            User::create([
                'name'          => $faker->name(),
                'email'         => $faker->email(),
                'password'      => Hash::make('qwerty'),
                'address'       => $faker->address(),
                'phone_num'     => $faker->phoneNumber(),
                'birth_date'    => $faker->date()
            ]);
        }
    }
}
