<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    sponsorship: Array,
    id: String
});

</script>

<script>
export default {
    data() {
        return {
            output: ''
        }
    }, methods: {
        store(e) {
            e.preventDefault();


        }
    },
}
</script>

<template>
    <Head title="Sponsorship" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sponsorship</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               Sponsorship
               {{ output }}
                <form action="/" >
                    
                    <template v-for="(item, index) in sponsorship" :key="index">
                            <!-- SPONSORSHIP LIST -->
                        <input type="radio" name="sposnorship" :value="item.name" v-model="output"> 
                        <label :for="item.name">{{ item.name }} </label><br>
                        
                    </template>
                    <button @click="store" class="btn btn-primary mt-2">SEND</button>
                    <!-- <a :href="route('dashbord.apartment.sponsorship.store', output, item.id)" class="btn btn-primary mt-3">Send</a> -->
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
