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
        <img class="img" src="./img/dl_a01597558.jpg" alt="">

        <div class="row">
            <div class="col-8">
                <h1 class="pt-4">{{ apartment.title }} - Host: {{ apartment.user.name }}</h1>
                <div> {{ apartment.address }}</div>
                <hr>
                <span>
                    {{ apartment.beds }} Ospiti
                </span>
                <span>
                    {{ apartment.rooms }} camere da letto
                </span>
                <span>
                    {{ apartment.bathrooms }} Bagni
                </span>
                <span>
                    {{ apartment.square_meters }} Metri quadri
                </span>

                <hr>
            </div>
            <div class="col-4">
                <div class="card mt-4 p-4">
                    <div class="pb-3">
                        € {{ apartment.price }} notte
                    </div>
                    <button class="btn btn-primary">Invi aun Messaggio</button>

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

        <h2>description: {{ apartment.description }}</h2>
        <h2>Servizi:
            <span v-for="service in apartment.services">{{ service.name }} /</span>
        </h2>
        <h2>Proprietario: </h2>


        <Link :href="route('message.create', apartment.id)">Create Message</Link>
    </div>
</template>
    
<style lang="scss">
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;

.img {
    margin: 0 auto;
    padding-top: 20px;
    width: 40%;
}

h1 {
    font-size: 25px;
}
</style>
    



