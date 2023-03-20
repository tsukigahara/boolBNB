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
        <div class="row">

            <navBar :jumbo="false" />

            <!-- tag corretto -->
            <!-- <img src="{{ apartment.main_image }}" alt="no.img"> -->

            <!-- tag di prova -->
            <img class="ms_img col-12 col-md-6 mx-auto" src="./img/dl_a01597558.jpg" alt="">

            <div class="row mx-0 px-0">
                <div class="col-12 col-md-8">
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
                            Ogni prenotazione include una protezione gratuita in caso di cancellazione da parte dell'host,
                            di
                            inesattezze dell'annuncio e di altri problemi come le difficoltà in fase di check-in.
                        </div>
                    </div>
                    <hr>

                    <!-- stampa servizi in card -->
                    <div>
                        Servizi:
                    </div>

                    <div class="row gx-3">
                        <div class="my_service col-6 col-md-3 my-1 p-2" v-for="service in apartment.services">
                            {{ service.name }}
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
                <div class="col-12 col-md-4">
                    <div class="card mt-4 p-4">
                        <h3 class="pb-3">
                            € {{ apartment.price }} a notte
                        </h3>

                        <hr>

                        <form class="d-flex col-12" @submit.prevent="submit" v-if="!form.sent">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nome</label>
                                    <input type="text" name="name" class="form-control" placeholder=""
                                        aria-describedby="helpId" v-model="form.name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder=""
                                        aria-describedby="helpId" v-model="form.email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Scrivi il tuo messaggio</label>
                                    <textarea type="textarea" name="message" class="form-control" placeholder=""
                                        aria-describedby="helpId" v-model="form.message" required>
                                        </textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary me-3">Invia
                                        messaggio</button>
                                    <button type="reset" class="btn btn-warning ">Cancella messaggio</button>
                                </div>
                            </div>
                        </form>

                        <h3 class="text-center message" v-if="form.sent">Messaggio inviato correttamente</h3>

                        <div class=" text-center pt-2">
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
    </div>
</template>
    
<style lang="scss">
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;

// .ms_img {
//     margin: 0 auto;
//     margin-top: 20px;
//     width: 50%;
// }

h1 {
    font-size: 25px;
}

.my_service {
    border: 1px solid grey;
    border-radius: 20px;

}

.ms_card {
    // width: calc((98% / 4) - 10px);
    // margin: 5px 0;
    // padding: 5px;

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
    



