<?php

namespace App;

use App\Course;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function courses(){
        return $this->hasMany('App\Course');
    }
}
