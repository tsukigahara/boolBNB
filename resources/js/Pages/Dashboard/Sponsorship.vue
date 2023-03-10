<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({
    sponsorship: Array,
    id: String
});
const form = useForm({
    id: props.id,
    sponsorship: '',
});
const submit = () => {
    form.post(route('dashbord.apartment.sponsorship.store'), {
        onFinish: () => form.reset(),
    });
    // console.log(form);
};
</script>

<script>
export default {
    data() {
        return {

        }
    }, methods: {

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
                <form action="/" @submit.prevent="submit">
                    
                    <template v-for="(item, index) in sponsorship" :key="index">
                            <!-- SPONSORSHIP LIST -->
                        <input type="radio" name="sposnorship" :value="item.id" v-model="form.sponsorship"> 
                        <label :for="item.name">{{ item.name }} </label><br>
                        
                    </template>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <!-- <button @click="store" class="btn btn-primary mt-2">SEND</button> -->
                    <!-- <a :href="route('dashbord.apartment.sponsorship.store', output, item.id)" class="btn btn-primary mt-3">Send</a> -->
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
