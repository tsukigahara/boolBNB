<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
defineProps({
    services: Array,
});
const form = useForm({
    title: '',
    rooms: 0,
    beds: 0,
    bathrooms: 0,
    square_meters: 0,
    address: '',
    latitude: '',
    longitude: '',
    main_image: '',
    visible: true,
    price: 0,
    description: '',
    services_id: [],
});
const submit = () => {
    form.post(route('dashboard.apartments.store'), {
        onFinish: () => form.reset(),
    });
};
// console.log(apartment);
</script>

<template>
    <Head title="New apartment" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Public new apartment</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a class="btn btn-dark my-3" role="button" href="javascript: history.back()">Go back</a>
                <form class="d-flex" @submit.prevent="submit">
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="title" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.title" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Rooms</label>
                            <input type="number" name="rooms" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.rooms" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Beds</label>
                            <input type="number" name="beds" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.beds" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Bathrooms</label>
                            <input type="number" name="bathrooms" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.bathrooms" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Square meters</label>
                            <input type="number" name="square_meters" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.square_meters" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.address" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">latitude</label>
                            <input type="text" name="latitude" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.latitude" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">longitude</label>
                            <input type="text" name="longitude" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.longitude" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Main image</label>
                            <input type="text" name="main_image" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.main_image" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">price</label>
                            <input type="number" name="price" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.price" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" id="" class="form-control" placeholder="" aria-describedby="helpId"
                                v-model="form.description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-check-label" for="">SERVICES</label>
                            <div class="form-check">
                                <div class="mb-3" v-for="service in services">
                                    <input class="form-check-input" type="checkbox" :value="service.id" id=""
                                        name="services_id[]" v-model="form.services_id">
                                    <label class="form-check-label" for="">{{ service.name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary mr-3">Publish</button>
                            <button type="reset" class="btn btn-warning mr-3">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
