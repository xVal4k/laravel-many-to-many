<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Sport'
            ],
            [
                'name' => 'Politic'
            ],
            [
                'name' => 'Tecnology'
            ],
            [
                'name' => 'News'
            ],
            [
                'name' => 'Space'
            ],
            [
                'name' => 'Culture'
            ],
            [
                'name' => 'Gaming'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
