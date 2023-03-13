<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();
        // Ottieni tutti gli id degli appartamenti nella cartella "Apartment"
        $apartmentIds = Apartment::pluck('id')->toArray();
        // array delle sponsorship ancora attive
        $sponsorshipArray = [];

        foreach ($apartmentIds as $i) {

            // ottiene l'ultima sponsorship attiva per l'appartamento
            $sponsorship = optional(
                Apartment::find($i)->sponsorships()
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
                    // push nell'array degli apopartamenti sponsorizzati
                    $sponsorshipArray[] = $i;
                }
            }
        }

        return Inertia::render('Welcome', [
            'apartments' => $apartments,
            'sponsorshipArray' => $sponsorshipArray
        ]);
    }

    // show single apartment by id with relations
    public function show($id)
    {
        $apartment = Apartment::find($id);

        $apartment->load('services');
        $apartment->load('user');

        $user = User::all();
        $services = Service::all();

        return Inertia::render('SingleApartment', [
            "apartment" => $apartment,
            "services" => $services,
            "user" => $user,
        ]);
    }

    // delete apartment (and it will delete all relations)
    public function destroy($id)
    {
        $apartment = Apartment::find($id);

        //blocks other user to delete
        if ($apartment->user_id != auth()->user()->id) {
            return abort('403');
        }

        $apartment->user()->dissociate();
        $apartment->views()->delete();
        $apartment->messages()->delete();
        $apartment->sponsorships()->sync([]);
        $apartment->services()->sync([]);
        $apartment->delete();

        return redirect()->route('dashboard.apartments');
    }

    // create apartment (for create form page)
    public function create()
    {
        $services = Service::all();

        return Inertia::render('Dashboard/ApartmentCreate', [
            "services" => $services,
        ]);
    }

    //  store apartment
    public function store(Request $request)
    {


        $data = $request->validate([
            'title' => 'required|string|min:0|max:128',
            'rooms' => 'required|integer|min:0',
            'beds' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'square_meters' => 'required|integer|min:0',
            'address' => 'required|string|min:0|max:128',
            'main_image' => 'required|string|min:0|max:128',
            'visible' => 'required|boolean',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'services_id' => 'nullable|array',
        ]);

        //convert address in gps coordinates (tomtomAPI)///////
        $searchController = new SearchController;
        $address = preg_replace('/\s+/', '+', $data['address']);
        $response = json_encode($searchController->geocode($address));
        $result = json_decode($response);

        if (!(isset($result->original))) {
            // you can access this error in vue by $page.props.flash.TomTomError
            //to add errors modify Middleware/HandleInertiaRequests.php
            return redirect()->back()->with('TomTomError', 'The address is not valid');
        }

        $data['latitude'] = $result->original->lat;
        $data['longitude'] = $result->original->lon;
        ///////////////////////////////////////////////////////


        $apartment = Apartment::make($data);


        // one to many
        $user = User::find(auth()->user()->id);
        $apartment->user()->associate($user);
        $apartment->save();

        // many to many
        if (array_key_exists('services_id', $data)) {
            $services = Service::find($data['services_id']);
            $apartment->services()->sync($services);
        }

        return redirect()->route('dashboard.apartments');
    }


    public function edit($id)
    {
        $apartment = Apartment::find($id);

        //blocks other user to edit 
        if ($apartment->user_id != auth()->user()->id) {
            return abort('403');
        }

        $apartment->load('services');
        $services = Service::all();

        return Inertia::render('Dashboard/ApartmentEdit', [
            "apartment" => $apartment,
            "services" => $services,
        ]);
    }

    //  update apartment
    public function update(Request $request, $id)
    {
        $apartment = Apartment::find($id);

        //blocks other user to update 
        if ($apartment->user_id != auth()->user()->id) {
            return abort('403');
        }

        $data = $request->validate([
            'title' => 'required|string|min:0|max:128',
            'rooms' => 'required|integer|min:0',
            'beds' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'square_meters' => 'required|integer|min:0',
            'address' => 'required|string|min:0|max:128',
            'main_image' => 'required|string|min:0|max:128',
            'visible' => 'required|boolean',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'services_id' => 'nullable|array',
        ]);

        //convert address in gps coordinates (tomtomAPI)///////
        $searchController = new SearchController;
        $address = preg_replace('/\s+/', '+', $data['address']);
        $response = json_encode($searchController->geocode($address));
        $result = json_decode($response);

        if (!(isset($result->original))) {
            // you can access this error in vue by $page.props.flash.TomTomError
            //to add errors modify Middleware/HandleInertiaRequests.php
            return redirect()->back()->with('TomTomError', 'The address is not valid');
        }

        $data['latitude'] = $result->original->lat;
        $data['longitude'] = $result->original->lon;
        ///////////////////////////////////////////////////////

        $user = auth()->user();
        $apartment->update($data);
        $apartment->user()->associate($user);
        $apartment->save();

        if (array_key_exists('services_id', $data)) {

            $services = Service::find($data['services_id']);
            $apartment->services()->sync($services);
        }

        return redirect()->route('dashboard.apartments');
    }
}
