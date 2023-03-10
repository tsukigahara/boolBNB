<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    apartments: Array,
});
</script>

<template>
    <Head title="My apartments" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My apartments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ul>
                    <li v-for="(item, index) in apartments" :key="index">
                        <span class="text-success">{{ item.title }}</span> - {{ item.address }}
                        <a name="" id="" class="btn btn-primary" :href="route('dashboard.apartments.edit', item.id)"
                            role="button">Button</a>
                        <a class="btn btn-primary" role="button" :href="route('dasbord.apartment.message', item.id)">MESSAGE</a>
                        <a class="btn btn-primary" role="button" :href="route('dasbord.apartment.view', item.id)">VIEW</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
