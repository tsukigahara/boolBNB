<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

const props = defineProps({
    apartment: Object,
    services: Array,
});


const form = useForm({
    title: props.apartment.title,
    rooms: props.apartment.rooms,
    beds: props.apartment.beds,
    bathrooms: props.apartment.bathrooms,
    square_meters: props.apartment.square_meters,
    address: props.apartment.address,
    latitude: props.apartment.latitude,
    longitude: props.apartment.longitude,
    main_image: props.apartment.main_image,
    visible: props.apartment.visible,
    price: props.apartment.price,
    description: props.apartment.description,
    services_id: props.apartment.services,
});

const apartmentHasService = (serviceId) => {
    let present = false;
    props.apartment.services.forEach(element => {

        if (element.id == serviceId) {

            present = true;

        }
    });

    return present;

};



const pushId = (serviceId) => {
    const serviceIndex = form.services_id.findIndex((service) => service.id === serviceId);
    if (serviceIndex !== -1) {
        form.services_id.splice(serviceIndex, 1);
    } else {
        form.services_id.push({ id: serviceId });
    }
};



const submit = () => {

    form.post(route('dashboard.apartments.update', props.apartment.id));
};
</script>



<template>
    <Head title="My apartments" />

    <DashboardLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My apartments</h2>
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
                            <div class="form-text">
                                GPS COORDINATES: {{ form.latitude }}, {{ form.longitude }}
                            </div>
                            <div v-if="form.errors.address" class="text-sm text-red-600">{{ form.errors.address }}</div>
                            <div v-if="$page.props.flash.TomTomError" class="text-sm text-red-600">{{
                                $page.props.flash.TomTomError
                            }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Main image</label>
                            <input type="text" name="main_image" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.main_image">
                            <div v-if="form.errors.main_image" class="text-sm text-red-600">{{ form.errors.main_image }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">price</label>
                            <input type="number" name="price" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" v-model="form.price">
                            <div v-if="form.errors.price" class="text-sm text-red-600">{{ form.errors.price }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" id="" class="form-control" placeholder="" aria-describedby="helpId"
                                v-model="form.description"></textarea>
                            <div v-if="form.errors.description" class="text-sm text-red-600">{{ form.errors.description }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-check-label" for="">SERVICES</label>
                            <div class="mb-3">
                                <div class="form-check form-check-inline" v-for="service in services" :key="service.id">
                                    <input class="form-check-input" type="checkbox" :value="service.id" id=""
                                        name="services_id[]" @click="pushId(service.id)"
                                        :checked="apartmentHasService(service.id)">
                                    <label class="form-check-label" for="">{{ service.name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary mr-3">Update</button>
                            <button type="submit" class="btn btn-warning mr-3" @click="form.reset()">Undo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </DashboardLayout>
</template>
