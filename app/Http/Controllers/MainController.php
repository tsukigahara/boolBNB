<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Message;
use App\Models\Sponsorship;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{

    ////////////////// MESSAGES ////////////////////
    // SHOW
    public function showMessage($id)
    {
        $messages = Message::where('apartment_id', $id)->get();
        return Inertia::render('Dashboard/Messages', [
            'messages' => $messages
        ]);
    }


    ////////////////// VIEWS ////////////////////
    // SHOW
    public function countView($id)
    {
        $views = View::where('apartment_id', $id)->count();
        return Inertia::render('Dashboard/View', [
            'views' => $views
        ]);
    }


    ////////////////// SPONSORSHIP ////////////////////

    // view
    public function showSponsorship($id)
    {
        $sponsorship = Sponsorship::all();
        return Inertia::render('Dashboard/Sponsorship', [
            'sponsorship' => $sponsorship,
            'id' => $id
        ]);
    }

    public function storeSposnosrship(Request $request)
    {
        // var_dump($request);
        $data = $request->validate([
            'id' => 'required',
            'sponsorship' => 'required'
        ]);
        $apartment = Apartment::find($data['id']);
        $sponsorship = Sponsorship::find($data['sponsorship']);

        $apartment->sponsorships()->attach($sponsorship, ['created_at' => Carbon::now()]);

        return redirect()->route('dashboard.apartments');
    }
}
