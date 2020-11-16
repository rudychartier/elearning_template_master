<?php

use App\User;
use App\Course;
use App\Category;
use Cocur\Slugify\Slugify;
use Illuminate\Database\Seeder;


class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slugify = new Slugify();
        $course = new Course();
        
        
        $course->title = "Les bases";
        $course->subtitle = "de symfony";
        $course->slug =$slugify->slugify($course->title);
        $course->description = "TFFTYFYTFYTIVYTIFVYITFYTIFIYTFITYFYTFYTIFTYFTYIF";
        $course->price = 19.99;
        $course->category_id = Category::all()->random(1)->first()->id;
        $course->user_id = User::all()->random(1)->first()->id;
        $course->save();

        $course = new Course();
        $course->title = "Les ponts";
        $course->subtitle = "de symfony";
        $course->slug =$slugify->slugify($course->title);
        $course->description = "TFFTYFYTFYTIVYTIFVYITFYTIFIYTFITYFYTFYTIFTYFTYIF";
        $course->price = 19.99;
        $course->category_id = Category::all()->random(1)->first()->id;
        $course->user_id = User::all()->random(1)->first()->id;
        $course->save();
        
        $course = new Course();
        $course->title = "Les kebabs";
        $course->subtitle = "de symfony";
        $course->slug =$slugify->slugify($course->title);
        $course->description = "TFFTYFYTFYTIVYTIFVYITFYTIFIYTFITYFYTFYTIFTYFTYIF";
        $course->price = 19.99;
        $course->category_id = Category::all()->random(1)->first()->id;
        $course->user_id = User::all()->random(1)->first()->id;
        $course->save();
    }
}
