<?php

namespace App\Http\Controllers;

use App\Course;
use App\Section;
use App\CourseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    //authentification pour que les cours ne soit accessibles que par la personne connectée
    public function __construct(){
        $this->middleware('auth');
    }
    
    
    //fonction pour lister les cours
    public function index(){

        //Récupération des données du model CourseUser
        $coursesUser = CourseUser::where('user_id', Auth::user()->id)->get();
        return view('participant.courses',[
            'coursesUser'=> $coursesUser      
              ]);
    }
    //Montrer les cours
    public function show ($slug) {

            $course = Course::where('slug' , $slug)->firstOrFail();
            
            return view ('participant.course',[
                'course' => $course
            ]);
    }
    //montrer un chapitre en particulier
    public function section($slug,$section){
        
        $course = Course::where('slug' , $slug)->firstOrFail();
        $section = Section::where('slug', $section)->firstOrFail();
        

        return view ('participant.section',[
            'course'=>$course,
            'section'=>$section
        ]);
    }
}
