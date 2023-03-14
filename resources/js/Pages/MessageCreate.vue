<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { propsToAttrMap } from '@vue/shared';
const props = defineProps({
    apartment: Object,
    user: Array,
});
const form = useForm({
    name: '',
    email: '',
    message: '',
    apartment_id: props.apartment.id,
});
const submit = () => {
    form.post(route('message.store', props.apartment.id), {
        onFinish: () => form.reset(),
    });
};
// console.log(apartment);
</script>

<template>
    <h1>Nome appartamento:{{ apartment.title }}</h1>
    <h2>Proprietario {{ apartment.user.name }}</h2>

    <form class="d-flex" @submit.prevent="submit">
        <div class="col">
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId"
                    v-model="form.name" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">email</label>
                <input type="email" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId"
                    v-model="form.email" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">message</label>
                <input type="textarea" name="message" id="" class="form-control" placeholder="" aria-describedby="helpId"
                    v-model="form.message" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mr-3">Publish</button>
                <button type="reset" class="btn btn-warning mr-3">Reset</button>
            </div>
        </div>

    </form>
</template>

    

    



