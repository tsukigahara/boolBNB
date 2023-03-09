<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use App\Models\User;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Apartment::factory() -> count(100) -> make() -> each(function($apartment){
            // user-apartment
            $user = User::inRandomOrder()-> first();
            $apartment -> user() -> associate($user);
            $apartment -> save();

            // apartment-service
            $service = Service::inRandomOrder() -> limit(rand(5, 15)) -> get();
            $apartment -> services()-> attach($service);

            // apartment-sponsorship
            $sponsorship = Sponsorship::inRandomOrder() -> limit(rand(0,1)) ->get();
            $apartment -> sponsorships() -> attach($sponsorship);

        });
    }
}
