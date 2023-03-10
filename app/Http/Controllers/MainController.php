<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Message;
use App\Models\View;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{

    ////////////////// MESSAGES ////////////////////
    public function showMessage($id){
        $messages = Message::where('apartment_id', $id) -> get();
        return Inertia::render('Dashboard/Messages', [
            'messages' => $messages
        ]);
    }
    
    
    ////////////////// VIEWS ////////////////////
    public function countView($id){
        $views = View::where('apartment_id', $id) -> count();
        var_dump($views);
        return Inertia::render('Dashboard/View', [
            'views' => $views
        ]);
    }
}
