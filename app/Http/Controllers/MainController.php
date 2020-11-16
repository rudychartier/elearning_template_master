<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Clients\UdemyClients;

class MainController extends Controller
{

    public function __construct(UdemyClients $udemyClient){
        $this->udemyClient = $udemyClient;
    }
        

    public function home(){

        $udemy = $this->udemyClient->getUdemyCourses();
        $instructors = User::all();
        $category = Category::where('id',2)->firstOrFail();

        return view('main.home',[
            'instructors' => $instructors,
            'courses' => $udemy['results']
        ]);
    }
}
