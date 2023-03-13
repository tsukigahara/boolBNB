<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

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
    public function geocode($query) {

        $key = 'K5laxV5pEcYwFAsUYafGyEWiWJGmLw9f';
        $apiURL = 'https://api.tomtom.com/search/2/geocode/'. $query. '.json?key=' . $key;


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
    public function filterApartments($criteria, $radius) {

        $apartments = Apartment::all();
        $filteredApartments = [];
        $filterCriteria = $this -> geocode($criteria);
        $filterLat = $filterCriteria -> original['lat'];
        $filterLong = $filterCriteria -> original['lon'];

        foreach ($apartments as $apartment) {
            $apartmentLat = $apartment -> latitude;
            $apartmentLong = $apartment -> longitude;

            $distance = $this -> haversine($filterLat, $filterLong, $apartmentLat, $apartmentLong);
            
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


}
