<script setup>
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
    <Head title="I tuoi messaggi" />

    <DashboardLayout>
        <div class="container my-4 shadow p-3 rounded overflow-scroll">
            <h1>I tuoi messaggi</h1>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 my-3">
                <div class="col" v-for="message in state.messageArray">
                    <div class="card h-100 shadow">
                        <div class="card-header">
                            <h5 class="card-title">{{ message.name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ message.apartment.title }}</h6>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="card-text">{{ message.message }}</p>
                            <div>
                                <a name="" id="" class="btn btn-primary"
                                    :href="`mailto:${message.email}?subject=[BoolBNB] Your beautiful journey at ${message.apartment.title}!&body=Thank you for contacting me ${message.name}, I'm ${user.name} of ${message.apartment.title}!`"
                                    role="button">Rispondi</a>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{ message.created_at }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<style lang="scss" scoped></style>
