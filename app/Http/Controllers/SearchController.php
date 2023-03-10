<?php

namespace App\Http\Controllers;

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
    }
    // Possibile riscriverlo come haversine(coord1, coord2) con coordinate 1 prese dall'API di tomtom e coord2 dai dati della casa in questione nel database

}
