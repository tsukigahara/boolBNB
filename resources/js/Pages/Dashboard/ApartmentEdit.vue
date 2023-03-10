<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    apartment: Object,
    services: Array,
});


const form = useForm({
    title: props.apartment.title,
    rooms:props.apartment.rooms,
    beds:props.apartment.beds,
    bathrooms:props.apartment.bathrooms,
    square_meters:props.apartment.square_meters,
    address:props.apartment.address,
    latitude:props.apartment.latitude,
    longitude:props.apartment.longitude,
    main_image:props.apartment.main_image,
    visible: props.apartment.visible,
    price:props.apartment.price,
    description: props.apartment.description,
    services_id:props.apartment.services,
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
    
    form.post(route('dashboard.apartments.update', props.apartment.id), {
        onFinish: () => form.reset(),
    });
};
</script>



<template>
    <Head title="My apartments" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My apartments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                               <div class="mb-3" v-for="service in services" :key="service.id">
                                    <input
                                        class="form-check-input" type="checkbox" :value="service.id" id=""
                                        name="services_id[]" @click="pushId(service.id)"  :checked="apartmentHasService(service.id)"  >
                                    <label class="form-check-label" for="">{{ service.name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
