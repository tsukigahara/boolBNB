<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    apartment: Object,
    services: Array,
});
// console.log(apartment);
</script>

<template>
    <Head title="My apartments" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My apartments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form class="d-flex" :action="route('dashboard.apartments.update', apartment.id)" method="POST">
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="title" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Rooms</label>
                            <input type="number" name="rooms" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Beds</label>
                            <input type="number" name="beds" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Bathrooms</label>
                            <input type="number" name="bathrooms" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Square meters</label>
                            <input type="number" name="square_meters" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <input type="number" name="address" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">latitude</label>
                            <input type="number" name="latitude" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">longitude</label>
                            <input type="number" name="longitude" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Main image</label>
                            <input type="text" name="main_image" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">visible</label>
                            <input type="number" name="visible" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">price</label>
                            <input type="text" name="price" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" id="" class="form-control" placeholder=""
                                aria-describedby="helpId"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-check-label" for="">SERVICES</label>
                            <div class="form-check">
                                <div class="mb-3" v-for="service in services">
                                    <input v-for="item in apartment.services" class="form-check-input" type="checkbox"
                                        :value="service.id" id="" name="services[]"
                                        :checked="item.id == service.id ? false : true">
                                    <label class="form-check-label" for="">{{ service.name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                        <input type="hidden" name="_token" :value="csrf">
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
