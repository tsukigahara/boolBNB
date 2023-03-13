<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { objectToString } from '@vue/shared';
import { reactive, onMounted } from '@vue/runtime-core';


const props = defineProps({
    apartments: Object,
    user: Object,
    allApartments: Object,
});

const state = reactive({
    messageArray: []
});


onMounted(() => {
    props.apartments.forEach(apartment => {
        apartment.messages.forEach(message => {
            const dateString = message.created_at;
            const date = new Date(dateString);
            const formattedDate = date.toLocaleString();
            const apartmentMatch = props.apartments.find(a => a.id === message.apartment_id);
            state.messageArray.push({ ...message, created_at: formattedDate, apartment: apartmentMatch });
        });
    });
    state.messageArray.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
});



</script>


<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ti diamo il bentornato,
                <span class="text-capitalize">
                    {{ user.name }}
                </span>
            </h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                <div class="shadow bg-body rounded p-4">

                    <h2>
                        I tuoi messaggi
                    </h2>
                    <table class="table table-striped table-bordered my-2">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Apartment</th>
                                <th scope="col">From</th>
                                <th scope="col">Message</th>
                                <th scope="col">When</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr v-for="message in state.messageArray">
                                <th scope="row">{{ message.apartment.title }}</th>
                                <th scope="row">{{ message.name }}</th>
                                <td>{{ message.message }}</td>
                                <td>{{ message.created_at }}</td>
                                <td>
                                    <a name="" id="" class="btn btn-dark"
                                        :href="`mailto:${message.email}?subject=[BoolBNB] Your beautiful journey at ${message.apartment.title}!&body=Thank you for contacting me ${message.name}, I'm ${user.name} of ${message.apartment.title}!`"
                                        role="button">Reply</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
