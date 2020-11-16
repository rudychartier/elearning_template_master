<?php

namespace App\Http\Controllers;

use App\Course;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function store($id){

        $course =Course::find($id);
        $wishlist = \Cart::session(Auth::user()->id . '_wishlist')->add([

        'id' => $course->id,
        'name' => $course->title,
        'price' => $course->price,
        'quantity' => 1,
        'associatedModel' => $course
        ]);

        return redirect()->route('cart.index')->with('success','Cours ajouté à votre liste de souhaits !');

    }

    public function destroy($id){

        //Destruction 
        \Cart::session(Auth::user()->id . '_wishlist')->remove($id);
        return redirect()->route('cart.index')->with('success',' Votre Cours à été supprimé de votre liste de souhaits !');
        
    }

    public function toCart($id){

        //Passage d'un cours dans la liste de souhaits au panier(supression puis ajout)
        $course =Course::find($id);
        \Cart::session(Auth::user()->id . '_wishlist')->remove($id);
        //passage des paramètres à la variable $add avec une association avec le model course qui permettera d'aller chercher les données de course en dynamique dans blade
        $add = \Cart::session(Auth::user()->id)->add([

            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price,
            'quantity' => 1,
            'associatedModel' => $course
            ]);

            return redirect()->route('cart.index')->with('success','Cours ajouté à votre liste de courses !');
        
    }

    public function toWishList($id){

        //Passage d'un cours à la liste de souhaits(supression puis ajout)
        $course =Course::find($id);
        \Cart::session(Auth::user()->id)->remove($id);

        //passage des paramètres à la variable $add avec une association avec le model course qui permettera d'aller chercher les données de course en dynamique dans blade
        $add = \Cart::session(Auth::user()->id. '_wishlist')->add([

            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price,
            'quantity' => 1,
            'associatedModel' => $course
            ]);

            return redirect()->route('cart.index')->with('success','Cours ajouté à votre liste de courses !');
        
        
    }
}
