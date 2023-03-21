<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
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

    <div class="container">

        <a class="btn btn-primary mt-3" role="button" href="javascript: history.back()">Indietro</a>

        <div class="row tabella pt-3">
            <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12" v-for="message in messages">
                <div class="card mb-3">
                    <h5> da {{ message.name }}</h5>
                    <div>{{ message.email }}</div>
                    <p>{{ message.message }}</p>
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
