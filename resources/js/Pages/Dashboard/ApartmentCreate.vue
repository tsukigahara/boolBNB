<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

defineProps({
    services: Array,
    errors: Object,
});

const form = useForm({
    title: '',
    rooms: 0,
    beds: 0,
    bathrooms: 0,
    square_meters: 0,
    address: '',
    main_image: 'default.jpeg',
    visible: true,
    price: 0,
    description: '',
    services_id: [],
});

const submit = () => {
    form.post(route('dashboard.apartments.store'));
};

</script>

<template>
    <Head title="New apartment" />

    <DashboardLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Public new apartment</h2>
        </template>

        <div class="container py-3">
            <div class="d-flex justify-content-between">
                <h2>Compila il form</h2>

                <a class="btn btn-dark mb-3 mr-3" role="button" href="javascript: history.back()">Indietro</a>
            </div>

            <form class="d-flex" @submit.prevent="submit">
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
                    <div class="mb-3">
                        <label for="" class="form-label">Metri quadri</label>
                        <input type="number" name="square_meters" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" v-model="form.square_meters">
                        <div v-if="form.errors.square_meters" class="text-sm text-red-600">{{ form.errors.square_meters
                        }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Indirizzo</label>
                        <input type="text" name="address" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" v-model="form.address">
                        <div v-if="form.errors.address" class="text-sm text-red-600">{{ form.errors.address
                        }}</div>
                        <div v-if="$page.props.flash.TomTomError" class="text-sm text-red-600">{{
                            $page.props.flash.TomTomError
                        }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Immagine di copertina</label>
                        <input type="text" name="main_image" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" v-model="form.main_image">
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
                            v-model="form.description"></textarea>
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
