<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    apartments: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ul>
                    <li v-for="(item, index) in apartments" :key="index">
                        <span class="text-success">{{ item.title }}</span> - {{ item.address }}
                    </li>
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
