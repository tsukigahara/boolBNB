<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    views: Number,
});
</script>

<template>
    <Head title="Messagies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Views</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                <a class="btn btn-dark mb-3 mr-3" role="button" href="javascript: history.back()">Go back</a>
                <div>
                    NUMBER OF VIEW : {{ views }}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
