<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function indexMyApartments()
    {
        $user = User::find(auth()->user()->id);
        $apartments = $user->apartments()->orderBy('updated_at', 'desc')->get();
        $apartments->load('sponsorships');

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
                $numDuration =explode(':',$duration);
                $endDateString = $startDate->format('Y-m-d H:i:s');
                $endDate = Carbon::parse($endDateString)->addHours($numDuration[0]);

                // verifica se la sponsorship è ancora attiva
                $isExpired = Carbon::now()->greaterThan($endDate);

                if (!$isExpired) {
                    // push nell'array degli apopartamenti sponsorizzati
                    $sponsorshipArray[] = $i;
                }
            }
        }

        return Inertia::render('Dashboard/MyApartments', [
            'apartments' => $apartments,
            'sponsorshipArray' => $sponsorshipArray,
        ]);
    }

    public function dashboard()
    {
        $user = User::find(auth()->user()->id);
        $apartments = $user->apartments()->orderBy('updated_at', 'desc')->get();
        $apartments->load('sponsorships');
        $apartments->load(['messages' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return Inertia::render('Dashboard/Dashboard', [
            'user' => $user,
            'apartments' => $apartments,

        ]);
    }

    // // create apartment (for create form page)
    // public function createNewApartment()
    // {
    //     $services = Service::all();

    //     return Inertia::render('Dashboard/ApartmentCreate', [
    //         "services" => $services,
    //     ]);
    // }
}
