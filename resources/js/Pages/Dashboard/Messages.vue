<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    messages: Array,
});
</script>

<template>
    <Head title="Messagies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Messages</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ul>
                    <li v-for="(item, index) in messages" :key="index">
                        <h2>{{ item.name }}</h2>
                        <h3>{{ item.email }}</h3>
                        {{ item.message }}
                        <hr>
                    </li>
                    
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
