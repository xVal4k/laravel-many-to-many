<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use App\Category;
use App\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i <50; $i++) {
            $title = $faker->words(rand(3, 7), true);
            Post::create([
                'user_id'       => User::inRandomOrder()->first()->id,
                'category_id'   => Category::inRandomOrder()->first()->id,
                'title'         => $title,
                'content'       => $faker->words(rand(5, 20), true),
                'image'         => $faker->imageUrl(250, 300),
                'slug'          => Post::createSlug($title)
            ]);
        }
    }
}
