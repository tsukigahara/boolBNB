<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{

    // messages
    public function showMessage($id){
        $messages = Message::where('apartment_id', $id) -> get();
        return Inertia::render('Dashboard/Messages', [
            'messages' => $messages
        ]);
    }
}
