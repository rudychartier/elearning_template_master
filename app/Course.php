<?php

namespace App;

use App\Category;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function category(){
        return $this->belongsto('App\Category');
    }

    public function user(){
        return $this->belongsto('App\User');
    }

    public function sections(){
        return $this->hasMany('App\Section');
    }
    //Relation many to many de user.php
    public function participants(){
        return $this->belonsToMany('App\User');
    }
}
