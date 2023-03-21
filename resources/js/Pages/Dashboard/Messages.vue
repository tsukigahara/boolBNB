<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { objectToString } from '@vue/shared';
import { reactive, onMounted } from '@vue/runtime-core';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';


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
    <Head title="Messages" />

    <DashboardLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Messages</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                <a class="btn btn-dark mb-3 mr-3" role="button" href="javascript: history.back()">Go back</a>
                <table class="table table-striped table-bordered my-12">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">From</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody class="">
                        <tr v-for="message in messages">
                            <th scope="row">{{ message.name }}</th>
                            <td>{{ message.email }}</td>
                            <td>{{ message.message }}</td>
                            <td style="white-space: nowrap;">
                                options here
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </DashboardLayout>
</template>
