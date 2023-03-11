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
                <h3 v-for="message in state.messageArray">
                   {{ message.name }} - {{ message.created_at }}
                   <h4>Apartment: {{ message.apartment.title }}</h4>
                </h3>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
