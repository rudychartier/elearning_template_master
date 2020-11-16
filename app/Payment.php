<?php

namespace App;

use App\Course;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //Déclaration des variables venant du CheckoutController
    protected $fillable = [
        'course_id','amount', 'instructor_part', 'elearning_part', 'email'
    ];
    public function course(){
        return $this->belongsTo('App\Course');
    }
}
