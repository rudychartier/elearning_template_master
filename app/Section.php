<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function course(){
        return $this->belongsto('App\Course');
    }
}
