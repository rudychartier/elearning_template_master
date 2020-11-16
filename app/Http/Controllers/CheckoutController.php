<?php

namespace App\Http\Controllers;

use App\Payment;
use Stripe\Charge;
use Stripe\Stripe;
use App\CourseUser;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Managers\PaymentManager;

class CheckoutController extends Controller
{   
    //Appel à la classe PaymentManager pour accéder aux méthodes
    public function __construct(PaymentManager $paymentManager){
        $this->paymentManager = $paymentManager;
    }

    public function checkout(){

        return view ('checkout.payment');
    }

    public function charge(Request $request){
        \Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE_KEY')); 
        //Création des variables pour la taxe
        $cart = \Cart::session(Auth::user()->id);
        $tax = $cart->getTotal() /5;
        $roundedTax = round($tax , 2);
        
        //Try catch pour le paiement et la collecte des données
        try{
            $charge = \Stripe\Charge::create([
                //prix total avec la taxe ajoutée *100 car Stripe est en centimes
                'amount'=> ($cart->getTotal()+$roundedTax)*100,
                'currency'=> 'EUR',
                'description'=> 'Paiement via Elearning',
                'source'=> $request -> input('stripeToken'),
                'receipt_email' => Auth::user()->email

            ]);

            //Enregistrement des paiements associés
            foreach(\Cart::getContent() as $item){

                //Appel des functions de PaymentManager
                $instructor_part = $this->paymentManager->getInstructorPart($cart->getTotal() + $roundedTax);
                $elearning_part = $this->paymentManager->getElearningPart($cart->getTotal() + $roundedTax);


                //Création d'un paiement(il faut aussi déclarer les variables dans le model Payment pour pouvoir les utiliser)
                    Payment::create([
                        'course_id' => $item->model->id,
                        'amount'  => $cart->getTotal()+$roundedTax,
                        'instructor_part'  => $instructor_part,
                        'elearning_part'  => $elearning_part,
                        'email'  => Auth::user()->email                
                        ]);
                        //Création d'un CourseUser (il faut aussi déclarer les variables dans le model CourseUser.php pour pouvoir les utiliser)
                        CourseUser::create([
                            'user_id' => Auth::user()->id,
                            'course_id'=> $item->model->id
                        ]);
            }


            

            return redirect()->route('checkout.success')->with('success','Paiement accepté !');

        }catch(\Stripe\Exception\CardErrorException $error){
            throw $error;
        }
    }
    public function success(){
    
    //limite l'accès juste à la sortie du paiement
    if(!session()->has('success')){
        return redirect()->route('main.home');
    }
    //permet de sauvegarder le contenu
    $order = \Cart::session(Auth::user()->id)->getContent() ;
    //boucle des contenus à supprimer
    foreach(\Cart::session(Auth::user()->id)->getContent() as $cartItem){
        \Cart::remove($cartItem->id);
    }
        return view ('checkout.success',[
            'order'=> $order
        ]);
    }
}
