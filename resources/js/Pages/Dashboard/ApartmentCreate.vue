<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
defineProps({
    services: Array,
    errors: Object,
});
const form = useForm({
    title: null,
    rooms: null,
    beds: null,
    bathrooms: null,
    square_meters: null,
    address: null,
    main_image: null,
    visible: true,
    price: null,
    description: null,
    services_id: [],
});
const submit = () => {
    form.post(route('dashboard.apartments.store'));
};
</script>

<template>
    <Head title="New apartment" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Public new apartment</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                <a class="btn btn-dark mb-3 mr-3" role="button" href="javascript: history.back()">Go back</a>
                <form class="d-flex" @submit.prevent="submit">
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="title" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.title">
                            <div v-if="form.errors.title" class="text-sm text-red-600">{{ form.errors.title }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Rooms</label>
                            <input type="number" name="rooms" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.rooms">
                            <div v-if="form.errors.rooms" class="text-sm text-red-600">{{ form.errors.rooms }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Beds</label>
                            <input type="number" name="beds" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.beds">
                            <div v-if="form.errors.beds" class="text-sm text-red-600">{{ form.errors.beds }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Bathrooms</label>
                            <input type="number" name="bathrooms" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.bathrooms">
                            <div v-if="form.errors.bathrooms" class="text-sm text-red-600">{{ form.errors.bathrooms }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Square meters</label>
                            <input type="number" name="square_meters" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.square_meters">
                            <div v-if="form.errors.square_meters" class="text-sm text-red-600">{{ form.errors.square_meters
                            }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.address">
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
                            <label for="" class="form-label">price</label>
                            <input type="number" name="price" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.price">
                            <div v-if="form.errors.price" class="text-sm text-red-600">{{ form.errors.price
                            }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" id="" class="form-control" placeholder="" aria-describedby="helpId"
                                v-model="form.description"></textarea>
                            <div v-if="form.errors.description" class="text-sm text-red-600">{{ form.errors.description
                            }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-check-label" for="">SERVICES</label>
                            <div class="mb-3">
                                <div class="form-check form-check-inline" v-for="service in services">

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
