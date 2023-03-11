<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function indexMyApartments()
    {
        $user = User::find(auth()->user()->id);
        $apartments = $user->apartments()->orderBy('created_at', 'desc')->get();
        $apartments->load('sponsorships');

        return Inertia::render('Dashboard/MyApartments', [
            'apartments' => $apartments
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
            'apartments' => $apartments
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
