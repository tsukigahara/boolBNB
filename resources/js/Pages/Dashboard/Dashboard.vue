<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { objectToString } from '@vue/shared';
import {  onMounted } from '@vue/runtime-core';

const props = defineProps({
    apartments: Object,
    user: Object,
});

onMounted (() => {

    console.log(props.apartments);
} ) 



</script>


<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xxl text-gray-800 leading-tight mt-4">Ti diamo il bentornato, 
                <span class="text-capitalize">
                    {{ user.name  }}
                </span> 
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                <h2>
                    I tuoi messaggi
                </h2> 
                <h3 v-for="apartment in apartments">
                    Per l'appartamento: {{ apartment.title }}
                    <div v-for="message in  apartment.messages">
                        <h4>Da: {{ message.name }}</h4>
                        <h4>Email: {{ message.email }}</h4>
                        <h4>Messaggio: {{ message.message }}</h4>
                        <h5>Data invio: {{ message.created_at }}</h5>
                    </div>
                </h3>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
