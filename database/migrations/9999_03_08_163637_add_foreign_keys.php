<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   

        //VIEWS FOREIGN
        Schema::table('views', function (Blueprint $table) {
            $table -> foreignId('apartment_id')
                   -> constrained(); 
        });

        //MESSAGES FOREIGN
        Schema::table('messages', function (Blueprint $table) {
            $table -> foreignId('apartment_id')
            -> constrained();
        });

        //IMAGES FOREIGN
        Schema::table('images', function (Blueprint $table) {
            $table -> foreignId('apartment_id')
            -> constrained();
        });

        //USERS FOREIGN
        Schema::table('apartments', function (Blueprint $table) {
            $table -> foreignId('user_id')
            -> constrained();
        });
          
        //APARTMENT_SERVICE FOREIGN
        Schema::table('apartment_service', function (Blueprint $table) {
            $table -> foreignId('apartment_id')
            -> constrained();
            $table -> foreignId('service_id')
            -> constrained();
        });

        //APARTMENT_SPONSORSHIP FOREIGN
        Schema::table('apartment_sponsorship', function (Blueprint $table) {
            $table -> foreignId('apartment_id')
            -> constrained();
            $table -> foreignId('sponsorship_id')
            -> constrained();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //VIEWS FOREIGN
        Schema::table('views', function (Blueprint $table) {
            $table -> dropForeign('views_apartment_id_foreign'); 
        });

        //MESSAGES FOREIGN
        Schema::table('messages', function (Blueprint $table) {
            $table -> dropForeign('messages_apartment_id_foreign'); 

        });

        //IMAGES FOREIGN
        Schema::table('images', function (Blueprint $table) {
            $table -> dropForeign('images_apartment_id_foreign'); 

        });       
        
        //USERS FOREIGN
        Schema::table('apartments', function (Blueprint $table) {
            $table -> dropForeign('apartments_user_id_foreign'); 

        });     

        //APARTMENT_SERVICE FOREIGN
        Schema::table('apartment_service', function (Blueprint $table) {
            $table -> dropForeign('apartment_service_apartment_id_foreign'); 
            $table -> dropForeign('apartment_service_service_id_foreign'); 

        });   

        //APARTMENT_SPONSORSHIP FOREIGN
        Schema::table('apartment_sponsorship', function (Blueprint $table) {
            $table -> dropForeign('apartment_sponsorship_apartment_id_foreign'); 
            $table -> dropForeign('apartment_sponsorship_sponsorship_id_foreign'); 

        });   
    }
};
