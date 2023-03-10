<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    
    apartment: Object,
    services: Array,
    user: Array,

});
</script>

    
    <template>
        <h1>Title:{{apartment.title}}</h1>
        <h2>Rooms: {{ apartment.rooms }}</h2>
        <h2>Beds: {{ apartment.beds }}</h2>
        <h2>bathrooms: {{ apartment.bathrooms }}</h2>
        <h2>square_meters: {{ apartment.square_meters }}</h2>
        <h2>address: {{ apartment.address }}</h2>
        <h2>latitude: {{ apartment.latitude }}</h2>
        <h2>longitude: {{ apartment.longitude }}</h2>
        <h2>main_image: {{ apartment.main_image }}</h2>
        <h2>visible: {{ apartment.visible }}</h2>
        <h2>price: {{ apartment.price }}</h2>
        <h2>description: {{ apartment.description }}</h2>
        <h2>Servizi:
            <span v-for="service in apartment.services">{{ service.name }} /</span>
        </h2>
        <h2>Proprietario: {{ apartment.user.name }}</h2>





    </template>
    

    



