<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({
    sponsorship: Array,
    id: String,
    date: Object,
    sponsorshipBool: Boolean
});
const form = useForm({
    id: props.id,
    sponsorship: '',
});
const submit = () => {
    form.post(route('dashbord.apartment.sponsorship.store'), {
        onFinish: () => form.reset(),
    });

};
</script>

<script>
export default {
    data() {
        return {

        }
    }, methods: {

    }, created() {
    }
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
               <div v-if="!sponsorshipBool">
                <h3>L'abbonamento {{ sponsorship.name }} per questo appartamento &egrave; gi&aacute; attivo</h3>
               </div>
                <form action="/" @submit.prevent="submit" v-else>
                            <!-- SPONSORSHIP LIST -->
                    <table class="table">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col"></th>
                            <th scope="col">Nome Abbonamento</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Durata</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in sponsorship" :key="index">
                            <th scope="row">
                                <input type="radio" name="sposnorship" :value="item.id" v-model="form.sponsorship"> 
                            </th>
                            
                            <td>
                                <label :for="item.name">
                                    {{ item.name }}
                                </label>
                            </td>
                            <td>{{ item.price }} &euro;</td>
                            <td>{{ item.duration }}</td>
                        </tr>
                    
                    </tbody>
                    </table>
                      
                    <button type="submit" class="btn btn-primary">Add</button>
                    <!-- <button @click="store" class="btn btn-primary mt-2">SEND</button> -->
                    <!-- <a :href="route('dashbord.apartment.sponsorship.store', output, item.id)" class="btn btn-primary mt-3">Send</a> -->
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
