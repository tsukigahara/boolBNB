<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import navBar from './navBar.vue'

import { propsToAttrMap } from '@vue/shared';

const props = defineProps({
    apartment: Object,
    services: Array,
    user: Array,
});

const form = useForm({
    name: '',
    email: '',
    message: '',
    sent: false,
});

const submit = () => {
    form.post(route('message.store', props.apartment.id));
    form.sent = true,
        form.name = '',
        form.email = '',
        form.message = '';

};

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
                <h1 class="pt-4 ">{{ apartment.title }} - Host: {{ apartment.user.name }}</h1>
                <div> {{ apartment.address }}</div>
                <hr>

                <!-- sezione detttagli appartamento -->
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

                <!-- sezione air cover -->
                <div>
                    <img class="logo" src="./img/54e427bb-9cb7-4a81-94cf-78f19156faad.webp" alt="">

                    <div class="py-3">
                        Ogni prenotazione include una protezione gratuita in caso di cancellazione da parte dell'host, di
                        inesattezze dell'annuncio e di altri problemi come le difficoltà in fase di check-in.
                    </div>
                </div>
                <hr>

                <!-- stampa servizi in card -->
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

            <!-- colonna messaggi -->
            <div class="col-4">
                <div class="card mt-4 p-4">
                    <div class="pb-3">
                        € {{ apartment.price }} notte
                    </div>

                    <form class="d-flex" @submit.prevent="submit" v-if="!form.sent">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Nome</label>
                                <input type="text" name="name" class="form-control" placeholder="" aria-describedby="helpId"
                                    v-model="form.name" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder=""
                                    aria-describedby="helpId" v-model="form.email" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Scrivi il tuo messaggio</label>
                                <input type="textarea" name="message" class="form-control" placeholder=""
                                    aria-describedby="helpId" v-model="form.message" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary me-3">Invia
                                    messaggio</button>
                                <button type="reset" class="btn btn-warning ">Cancella messaggio</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center message" v-if="form.sent">Messaggio inviato correttamente</div>
                    <hr>

                    <div class=" text-center">
                        non riceverai alcun addebito in questa fase
                    </div>
                    <hr>
                    <div>
                        Totale: € {{ apartment.price }}
                    </div>
                </div>
            </div>
        </div>

        <!-- <h2>latitude: {{ apartment.latitude }}</h2> -->
        <!-- <h2>longitude: {{ apartment.longitude }}</h2> -->
        <!-- <h2>visible: {{ apartment.visible }}</h2> -->

    </div>
</template>
    
<style lang="scss">
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;

.ms_img {
    margin: 0 auto;
    margin-top: 20px;
    width: 45%;
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

.btn-primary {
    color: white;
}

a {
    color: white;

    &:hover {
        color: white;
    }
}

.message {
    color: green;
}
</style>
    



