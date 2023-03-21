<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { computed } from 'vue'
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { store } from '../../store';
import axios from 'axios';

defineProps({
    services: Array,
    errors: Object,
});

const form = useForm({
    title: '',
    rooms: null,
    beds: null,
    bathrooms: null,
    square_meters: null,
    address: store.createAddress,
    main_image: 'default.jpeg',
    visible: true,
    price: null,
    description: '',
    services_id: [],
});

const submit = () => {
    form.post(route('dashboard.apartments.store'));
};

// boolean per il v-if delle suggestioni
var suggestionsDropdownCheck = false;

//osserva la lunghezza del input e decide se chiamare tomtom api 
let autocompleateTrigger = computed(() => {
    if (store.createAddress.length >= 3) {
        autocompleate(store.createAddress)
    }
    if (store.createAddress.length < 3) {
        suggestionsDropdownCheck = false;
    }
});

//richiesta tomtom api = ritorna in forma di array i suggestions 
const autocompleate = (string) => {
    let query = string.replace(/\s/g, '+');
    const url = `${store.autocompleteAPI}/${query}`;
    axios.get(url)
        .then(res => {
            store.autocompleteArray = res.data.response.data
            // console.log(store.autocompleteArray)
        })
        .catch(err => {
            console.log(err)
        });
    suggestionsDropdownCheck = true;
};

const pickSuggestion = (suggestion) => {
    suggestionsDropdownCheck = false;
    form.address = suggestion;
    store.createAddress = suggestion;
}
</script>

<template>
    <Head title="New apartment" />

    <DashboardLayout>
        <div class="container my-4 shadow p-3 rounded overflow-scroll">
            <h2>Pubblica l'appartamento</h2>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary mb-3 mr-3" role="button" href="javascript: history.back()">Indietro</a>
            </div>
            <form class="d-flex px-md-2" @submit.prevent="submit">
                <div class="col">
                    <div class="mb-3">
                        <label for="" class="form-label">Nome appartamento</label>
                        <input type="text" name="title" id="" class="form-control" placeholder="" aria-describedby="helpId"
                            v-model="form.title">
                        <div v-if="form.errors.title" class="text-sm text-red-600">{{ form.errors.title }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Camere</label>
                        <input type="number" name="rooms" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" v-model="form.rooms">
                        <div v-if="form.errors.rooms" class="text-sm text-red-600">{{ form.errors.rooms }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Letti</label>
                        <input type="number" name="beds" id="" class="form-control" placeholder="" aria-describedby="helpId"
                            v-model="form.beds">
                        <div v-if="form.errors.beds" class="text-sm text-red-600">{{ form.errors.beds }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Bagni</label>
                        <input type="number" name="bathrooms" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" v-model="form.bathrooms">
                        <div v-if="form.errors.bathrooms" class="text-sm text-red-600">{{ form.errors.bathrooms }}</div>
                    </div>
                    <div class="mb-3 ">
                        <label for="" class="form-label">Metri quadri</label>
                        <input type="number" name="square_meters" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" v-model="form.square_meters">
                        <div v-if="form.errors.square_meters" class="text-sm text-red-600">{{ form.errors.square_meters
                        }}</div>
                    </div>
                    <div class="mb-3 suggestions-box">
                        <label for="" class="form-label">Indirizzo</label>
                        <input type="text" name="address" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" v-model="store.createAddress" @input="autocompleateTrigger">
                        <div v-if="suggestionsDropdownCheck" class="suggestions-items">
                            <div class="suggestions-item" v-for="elem in store.autocompleteArray?.suggestions?.results"
                                @click="pickSuggestion(`${elem.address.freeformAddress} ${elem.address.countrySecondarySubdivision} ${elem.address.countrySubdivision} ${elem.address.country}`)">
                                {{ elem.address.freeformAddress }}, {{ elem.address.countrySecondarySubdivision }}, {{
                                    elem.address.countrySubdivision }}, {{ elem.address.country }}
                            </div>
                        </div>
                        <div v-if="form.errors.address" class="text-sm text-red-600">{{ form.errors.address
                        }}</div>
                        <div v-if="$page.props.flash.TomTomError" class="text-sm text-red-600">{{
                            $page.props.flash.TomTomError
                        }}</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Main image</label>
                        <input type="file" @input="form.main_image = $event.target.files[0]" class="form-control" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                        <div v-if="form.errors.main_image" class="text-sm text-red-600">{{ form.errors.main_image
                        }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Prezzo</label>
                        <input type="number" name="price" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" v-model="form.price">
                        <div v-if="form.errors.price" class="text-sm text-red-600">{{ form.errors.price
                        }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Descrizione</label>
                        <textarea name="description" id="" class="form-control" placeholder="" aria-describedby="helpId"
                            v-model="form.description" style="min-height:200px;"></textarea>
                        <div v-if="form.errors.description" class="text-sm text-red-600">{{ form.errors.description
                        }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label" for="">Servizi aggiuntivi</label>
                        <div class="mb-3">
                            <div class="form-check form-check-inline" v-for="service in services">

                                <input class="form-check-input" type="checkbox" :value="service.id" id=""
                                    name="services_id[]" v-model="form.services_id">
                                <label class="form-check-label" for="">{{ service.name }}</label>

                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary mr-3">Pubblica</button>
                        <button type="reset" class="btn btn-warning mr-3">Reset</button>
                    </div>
                </div>
            </form>
        </div>

    </DashboardLayout>
</template>

<style lang="scss" scoped>
@use "../../../scss/app.scss" as *;
@use "../../../scss/general.scss" as *;

.suggestions-box {
    /*the container must be positioned relative:*/
    position: relative;

    .suggestions-items {
        position: absolute;
        border: 1px solid #ced4da;
        border-top: none;
        z-index: 99;
        top: 100%;
        left: 0;
        right: 0;
        max-height: 250px;
        overflow-y: auto;

        .suggestions-item {
            padding: 10px;
            cursor: pointer;
            background-color: #f5f5f5;
            border-bottom: 1px solid #d4d4d4;

            &:hover {
                background-color: #e9e9e9;
            }
        }
    }
}
</style>