<script setup>
import { Head, Link } from '@inertiajs/vue3';
import navBar from './navBar.vue'

defineProps({

    apartment: Object,
    services: Array,
    user: Array,

});
</script>
 
<template>
    <div class="container">
        <navBar />

        <!-- tag corretto -->
        <!-- <img src="{{ apartment.main_image }}" alt="no.img"> -->

        <!-- tag di prova -->
        <img class="ms_img" src="./img/dl_a01597558.jpg" alt="">

        <div class="row">
            <div class="col-8">
                <h1 class="pt-4">{{ apartment.title }} - Host: {{ apartment.user.name }}</h1>
                <div> {{ apartment.address }}</div>
                <hr>
                <div>
                    <span>
                        {{ apartment.beds }} Ospiti -
                    </span>
                    <span>
                        {{ apartment.rooms }} camere da letto -
                    </span>
                    <span>
                        {{ apartment.bathrooms }} Bagni -
                    </span>
                    <span>
                        {{ apartment.square_meters }} Metri quadri
                    </span>
                </div>

                <hr>

                <div>
                    <img class="logo" src="./img/54e427bb-9cb7-4a81-94cf-78f19156faad.webp" alt="">

                    <div class="py-3">
                        Ogni prenotazione include una protezione gratuita in caso di cancellazione da parte dell'host, di
                        inesattezze dell'annuncio e di altri problemi come le difficoltà in fase di check-in.
                    </div>
                </div>
                <hr>
                <div>
                    Servizi:
                </div>

                <div class="d-flex flex-wrap justify-content-round">
                    <div class="ms_card" v-for="service in apartment.services">
                        {{ service.name }} <br>
                    </div>
                </div>
                <hr>
                <div>
                    Descrizione:
                    <p>
                        {{ apartment.description }}
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="card mt-4 p-4">
                    <div class="pb-3">
                        € {{ apartment.price }} notte
                    </div>

                    <button class="btn btn-primary">
                        <Link :href="route('message.create', apartment.id)">
                        invia un messsaggio
                        </Link>
                    </button>



                <div class="pt-3 text-center">
                        non riceverai alcun addebito in questa fase
                    </div>
                    <hr>
                    <div>
                        Totale: € {{ apartment.price }}
                    </div>
                </div>
            </div>
        </div>

        <!-- <h2>latitude: {{ apartment.latitude }}</h2>
                                                                                                                                                        <h2>longitude: {{ apartment.longitude }}</h2>
                                                                                                                                                        <h2>visible: {{ apartment.visible }}</h2> -->

    </div>
</template>
    
<style lang="scss">
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;

.ms_img {
    margin: 0 auto;
    margin-top: 20px;
    width: 60%;
}

h1 {
    font-size: 25px;
}

.ms_card {
    width: calc((98% / 4) - 10px);
    margin: 5px;
    padding: 5px;
    border: 1px solid grey;
    border-radius: 20px;
}

.logo {
    width: 20%;
}
</style>
    



