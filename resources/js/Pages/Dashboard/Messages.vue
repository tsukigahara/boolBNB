<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { objectToString } from '@vue/shared';
import { reactive, onMounted } from '@vue/runtime-core';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';


defineProps({
    messages: Array,
});





</script>

<template>
    <Head title="Messages" />

    <DashboardLayout>


        <div class="container my-4 shadow p-3 rounded overflow-scroll">
            <h1>I tuoi messaggi</h1>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary mt-3" role="button" href="javascript: history.back()">Indietro</a>
            </div>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 my-3">
                <div class="col" v-for="message in messages">
                    <div class="card h-100 shadow">
                        <div class="card-header">
                            <h5 class="card-title">{{ message.name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ message.apartment.title }}</h6>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                        <p class="card-text">{{ message.message }}</p>
                        <div>
                            <a id="" class="btn btn-primary"
                                :href="`mailto:${message.email}?subject=[BoolBNB] Your beautiful journey at ${message.apartment.title}!&body=Thank you for contacting me ${message.name}, I'm ${$page.props.auth.user.name} of ${message.apartment.title}!`"
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



    <!-- <template #header>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Messages</h2>
                    </template>

                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                            <a class="btn btn-dark mb-3 mr-3" role="button" href="javascript: history.back()">Go back</a>
                            <table class="table table-striped table-bordered my-12">
                                <thead class="table-dark">
                                    <tr>
                                            <th scope="col">From</th>
                                            <th scope="col">Email</th>
                                                                                                                <th scope="col">Message</th>
                                                                                                                <th scope="col">Options</th>

                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody class="">
                                                                                                            <tr v-for="message in messages">
                                                                                                                <th scope="row">{{ message.name }}</th>
                                                                                                                <td>{{ message.email }}</td>
                                                                                                                <td>{{ message.message }}</td>
                                                                                                                <td style="white-space: nowrap;">
                                                                                                                    options here
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div> -->
    </DashboardLayout>
</template>
