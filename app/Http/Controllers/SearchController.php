<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Sponsorship;
use Carbon\Carbon;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function haversine($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515 * 1.609344;
        return (round($distance, 2));
        // Possibile riscriverlo come haversine(coord1, coord2) con coordinate 1 prese dall'API di tomtom e coord2 dai dati della casa in questione nel database
    }
    public function geocode($query)
    {

        $key = 'K5laxV5pEcYwFAsUYafGyEWiWJGmLw9f';
        $apiURL = 'https://api.tomtom.com/search/2/geocode/' . $query . '.json?key=' . $key;


        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ]
        ]);

        $response = file_get_contents($apiURL, false, $context);

        if ($response) {
            $responseJson = json_decode($response, true);
        }

        if (isset($responseJson['results'][0]['position'])) {
            return response()->json($responseJson['results'][0]['position']);
        }
    }
    public function filterApartments($criteria, $radius)
    {

        $apartments = Apartment::all();
        $apartments->load('services');
        $filteredApartments = [];
        $filterCriteria = $this->geocode($criteria);
        $filterLat = $filterCriteria->original['lat'];
        $filterLong = $filterCriteria->original['lon'];

        foreach ($apartments as $apartment) {
            $apartmentLat = $apartment->latitude;
            $apartmentLong = $apartment->longitude;

            $distance = $this->haversine($filterLat, $filterLong, $apartmentLat, $apartmentLong);

            if ($distance <= $radius) {
                array_push($filteredApartments, $apartment);
            }
        }

        return response()->json([
            "success" => true,
            "response" => [
                "data" => [
                    "filteredApartments" => $filteredApartments,
                ],
            ]
        ]);
    }
    public function searchServices()
    {
        $services = Service::all();

        return response()->json([
            "success" => true,
            "response" => [
                "data" => [
                    "services" => $services,
                ],
            ]
        ]);
    }

    public function filteredPage()
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

        return Inertia::render('FilteredPage', [
            'apartments' => $apartments,
            'sponsorshipArray' => $sponsorshipArray
        ]);
    }
    public function autocomplete($query)
    {

        $key = 'K5laxV5pEcYwFAsUYafGyEWiWJGmLw9f';
        $apiURL = 'https://api.tomtom.com/search/2/search/' . $query . '.json?key=' . $key;


        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ]
        ]);

        $response = file_get_contents($apiURL, false, $context);

        if ($response) {
            $responseJson = json_decode($response, true);
        }

        return response()->json([
            "success" => true,
            "response" => [
                "data" => [
                    "suggestions" => $responseJson,
                ],
            ]
        ]);
    }
}
