<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Message;
use App\Models\Service;
use App\Models\User;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Validator;
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

    public function messageCreate($id)
    {
        $apartment = Apartment::find($id);

        $apartment->load('user');
        
        $user = User :: all();

        return Inertia::render('MessageCreate', [
            "apartment" => $apartment,
            "user" => $user,        ]);
    }

    public function messageStore(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:0|max:128',
            'email' => 'required|string|min:0|max:128',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->all();

        $message = Message::make($data);


        // one to many
        $apartment = Apartment::find($id);
        $message->apartment()->associate($apartment);
        $message->save();

        return redirect()->route('show', $id);
    }

    ////////////////// VIEWS ////////////////////

        // SHOW
    public function countView($id){
        $views = View::where('apartment_id', $id) -> count();

        return Inertia::render('Dashboard/View', [
            'views' => $views
        ]);
    }


    ////////////////// SPONSORSHIP ////////////////////

        public function showSponsorship($id){
    // ottiene tutte le sponsorship
    $sponsorshipAll = Sponsorship::all();

    // ottiene l'ultima sponsorship attiva per l'appartamento
    $sponsorship = optional(
        Apartment::find($id)->sponsorships()
        ->withPivot('sponsorship_id', 'created_at')
        ->orderBy('pivot_created_at', 'desc')
        ->first()
    );

    // verifica che il valore non sia null
    if (optional($sponsorship)->pivot) {
        // ottiene l'id della sponsorship
        $sponsorshipId = optional($sponsorship)->pivot->sponsorship_id;

        // ottiene la data di inizio sponsorship
        $startDate = optional($sponsorship)->pivot->created_at;

        // calcola la data di fine sponsorship
        $duration = Sponsorship::find($sponsorshipId)->duration;
        $endDate = Carbon::parse($startDate)->addHours($duration);

        // verifica se la sponsorship è ancora attiva
        $isExpired = Carbon::now()->greaterThan($endDate);

        if ($isExpired) {
            // la sponsorship è scaduta
            return Inertia::render('Dashboard/Sponsorship', [
                'sponsorship' => $sponsorshipAll,
                'id' => $id,
                'date' => $sponsorship,
                'sponsorshipBool' => false
            ]);
        } else {
            // la sponsorship è ancora attiva
            return Inertia::render('Dashboard/Sponsorship', [
                'sponsorship' => $sponsorshipAll,
                'id' => $id,
                'date' => null,
                'sponsorshipBool' => true
            ]);
        }  
    } else {
        // non ci sono sponsorship attive per l'appartamento
        return Inertia::render('Dashboard/Sponsorship', [
            'sponsorship' => $sponsorshipAll,
            'id' => $id,
            'date' => null,
            'sponsorshipBool' => true
        ]);
    }
}

            
    public function storeSposnosrship(Request $request){
        
        $data= $request -> validate([
            'id' => 'required',
            'sponsorship' => 'required'
        ]);
        $apartment= Apartment::find($data['id']);
        $sponsorship= Sponsorship::find($data['sponsorship']);

        $apartment->sponsorships()->attach($sponsorship, ['created_at' => Carbon::now()]);

        return redirect() -> route('dashboard.apartments');
    }
    public function verificateSponsorship(){
        $apartment= Apartment::find(1) ->get();
        $sposnsorshipId = $apartment->sponsorship()->where('id', );
        return Inertia::render('Dashboard/Sponsorship' ,[
            
        ]); 
    }
    public function payment (Request $request){
        $data = $request ->validate([
            'id' => 'required',
            'sponsorship' => 'required',

        ]);
        $sponsorship = Sponsorship::find($data['sponsorship']);

        return Inertia::render('Dashboard/Payment',[
            'id' => $data['id'],
            'sponsorship'=> $data['sponsorship'],
            'price' => $sponsorship
        ]);
    }

    
}
