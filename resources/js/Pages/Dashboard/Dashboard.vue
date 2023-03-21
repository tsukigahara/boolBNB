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
    <Head title="Dashboard" />

<DashboardLayout>



    <div class="container">

        <div class="ms_navbar py-2">
            <h2 class="py-3">
                I tuoi messaggi:
            </h2>
        </div>

        <div class="row tabella">
            <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12" v-for="message in state.messageArray">
                <div class="card mb-3">
                    <h5>{{ message.apartment.title }}</h5>
                    <div>{{ message.created_at }}</div>
                    <div>{{ message.name }}</div>
                    <p>{{ message.message }}</p>

                        <div class="row pt-3">
                            <div class="col-6 mb-2 text-center">
                                <a name="" id="" class="btn btn-primary text-center"
                                    :href="`mailto:${message.email}?subject=[BoolBNB] Your beautiful journey at ${message.apartment.title}!&body=Thank you for contacting me ${message.name}, I'm ${user.name} of ${message.apartment.title}!`"
                                    role="button">Rispondi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="tabella">
                                                                <table class="table table-striped table-bordered my-2">
                                                                    <thead class="table-secondary">
                                                                        <tr>
                                                                            <th scope="col">Apartmento</th>
                                                                            <th scope="col">Da</th>
                                                                            <th scope="col">Messaggio</th>
                                                                            <th scope="col">Quando</th>
                                                                            <th scope="col">Opzioni</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="message in state.messageArray">
                                                                            <th scope="row">{{ message.apartment.title }}</th>
                                                                            <th scope="row">{{ message.name }}</th>
                                                                            <td>{{ message.message }}</td>
                                                                            <td>{{ message.created_at }}</td>
                                                                            <td>
                                                                                <a name="" id="" class="btn btn-primary text-center"
                                                                                    :href="`mailto:${message.email}?subject=[BoolBNB] Your beautiful journey at ${message.apartment.title}!&body=Thank you for contacting me ${message.name}, I'm ${user.name} of ${message.apartment.title}!`"
                                                                                    role="button">Rispondi</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div> -->

        </div>
    </DashboardLayout>
</template>

<style lang="scss" scoped>
@use "../../../scss/app.scss" as *;
@use "../../../scss/general.scss" as *;

.container {
    height: calc(100vh - 70px);
}

.ms_navbar {
    height: 120px;
}

.tabella {
    height: calc(100% - 140px);
    overflow: auto;
}

.card {
    padding: 10px;
}

.ms_navbar {
    height: 85px;
}

.tabella {
    height: calc(100% - 85px);
    overflow: auto;
}
</style>
