<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ApartmentController extends Controller
{
    // show all apartments with paginations (12 elementi alla volta)
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $apartments = $user->apartments()->orderBy('created_at', 'desc')->get();
        $apartments->load('sponsorships');

        return Inertia::render('Dashboard/MyApartments', [
            'apartments' => $apartments
        ]);
    }

    // show single apartment by id with relations
    public function show(Apartment $apartment)
    {
        $apartment->load('user');
        $apartment->load('images');
        $apartment->load('services');
        $apartment->load('sponsorships');

        return response()->json([
            "success" => true,
            "response" => [
                "data" => [
                    "apartments" => $apartment
                ],
            ]
        ]);
    }

    // delete apartment (and it will delete all relations)
    public function destroy(Apartment $apartment)
    {
        $apartment->user()->dissociate();
        $apartment->views()->delete();
        $apartment->messages()->delete();
        $apartment->images()->delete();
        $apartment->sponsorships()->sync([]);
        $apartment->services()->sync([]);
        $apartment->delete();

        return response()->json([
            'success' => true
        ]);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:0|max:128',
            'rooms' => 'required|integer|min:0',
            'beds' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'square_meters' => 'required|integer|min:0',
            'address' => 'required|string|min:0|max:128',
            'latitude' => 'required|string|min:0|max:16',
            'longitude' => 'required|string|min:0|max:16',
            'main_image' => 'required|string|min:0|max:128',
            'visible' => 'required|boolean',
            'price' => 'required|integer|min:0',
            'description' => 'string',
            'services_id' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->all();

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

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:0|max:128',
            'rooms' => 'required|integer|min:0',
            'beds' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'square_meters' => 'required|integer|min:0',
            'address' => 'required|string|min:0|max:128',
            'latitude' => 'required|string|min:0|max:16',
            'longitude' => 'required|string|min:0|max:16',
            'main_image' => 'required|string|min:0|max:128',
            'visible' => 'required|boolean',
            'price' => 'required|integer|min:0',
            'description' => 'string',
            'services_id' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->all();


        $user = auth()->user();
        $apartment->update($data);
        $apartment->user()->associate($user);
        $apartment->save();

        if (array_key_exists('services_id', $data)) {

            $services = Service::find($data['services_id']);
            $apartment->tags()->sync($services);
        }

        return redirect()->route('dashboard.apartments');
    }
}
