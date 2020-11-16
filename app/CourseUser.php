<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//relations avec les tables course et user
class CourseUser extends Model
{

    //Après le changement de nom de la table create_users to create_user pour permettre à la base de données de reconnaître la table
    protected $table = 'course_user';

    //Paramétrage de course_id et user_id dans le CheckoutController
    protected $fillable = [
        'user_id' , 'course_id'
    ];

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
