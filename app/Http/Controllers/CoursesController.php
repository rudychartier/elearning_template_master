<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
   public function courses(){
       $courses = Course::where('is_published' , true)->get();
       return view ('courses.index',[
            'courses'=> $courses
       ]);
   }

   public function course($slug){

       $course= Course::where('slug', $slug)->firstOrFail();
       $recommandations = Course::where('is_published', true)->where('category_id', $course->category_id)->where('id', '!=' , $course->id )->limit(3)->get();

       //if si propriétaire du cours ou cours déjà acheté

       if(Auth::user()->paidCourses->where('title', $course->title)->count() != 0 || Auth::user()->courses->where('title', $course->title)->count() != 0 ){
          die('Propriétaire du cours ou cours déjà acheté ! ');
       }

       return view ('courses.show',[
           'course'=> $course,
           'recommandations' => $recommandations,
       ]);
   }
   //permet de filtrer les category dans le incs>courses>category_banner et le incs>auth>header
   public function filter($id){

       $category = Category::find($id);
       $courses = Course::where('category_id', $category->id)->where('is_published',true)->get();

       return view ('courses.index',[
           'courses'=>$courses
       ]);
   }
}
