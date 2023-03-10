<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Message;
use App\Models\Sponsorship;
use App\Models\View;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{

    ////////////////// MESSAGES ////////////////////
        // SHOW
    public function showMessage($id){
        $messages = Message::where('apartment_id', $id) -> get();
        return Inertia::render('Dashboard/Messages', [
            'messages' => $messages
        ]);
    }
    
    
    ////////////////// VIEWS ////////////////////
        // SHOW
    public function countView($id){
        $views = View::where('apartment_id', $id) -> count();
        var_dump($views);
        return Inertia::render('Dashboard/View', [
            'views' => $views
        ]);
    }


        ////////////////// SPONSORSHIP ////////////////////

        // view
        public function showSponsorship($id){
            $sponsorship= Sponsorship::all();
            return Inertia::render('Dashboard/Sponsorship' ,[
                'sponsorship' => $sponsorship,
                'id'=> $id
            ]);
        }

        public function storeSposnosrship(Request $request){
            // $data= $request -> validate([
            //     'id' => 'required',
            //     'ps' => 'required'
            // ]);
            // $apartment= Apartment::find($data['id']);
            // $sponsorship= Sponsorship::make($data['ps']);
            // $sponsorship -> apartment() -> associate($apartment);
            // $sponsorship -> save();

            return route('dasbord.apartment.view');
        }

}
