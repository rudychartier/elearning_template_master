<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->icon = '<i class="fab fa-accusoft"></i>';
        $category->name = "Développement logiciel";
        $category->save();

        $category = new Category();
        $category->icon = '<i class="fas fa-copy"></i>';
        $category->name = "Développement Web";
        $category->save();

        $category = new Category();
        $category->icon = '<i class="fas fa-apple-alt"></i>';
        $category->name = "Infrastructure";
        $category->save();
    }
}
