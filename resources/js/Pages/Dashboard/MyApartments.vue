<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

// props
defineProps({
    apartments: Array,
});

// delete
const form = useForm({});
function destroy(id) {
    if (confirm("Are you sure you want to Delete?")) {
        form.delete(route("dashboard.apartments.destroy", id), {
            preserveScroll: true,
            onFinish: () => form.reset(),
        });
    }
}

</script>

<template>
    <Head title="My apartments" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My apartments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                <!-- bottone per creare nuovo apartament -->
                <a name="" id="" class="btn btn-primary" :href="route('dashboard.apartments.create')" role="button">Public
                    new apartment</a>
                <!-- tabella -->
                <table class="table table-striped table-bordered my-12">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Address</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr v-for="apartment in apartments">
                            <th scope="row">{{ apartment.title }}</th>
                            <td>{{ apartment.address }}</td>
                            <td>{{ apartment.description }}</td>
                            <td>€{{ apartment.price }}</td>
                            <td style="white-space: nowrap;">
                                <a class="btn btn-primary mx-2" :href="route('dashboard.apartments.edit', apartment.id)"
                                    role="button">Edit</a>
                                <a class="btn btn-dark mx-2" role="button"
                                    :href="route('dasbord.apartment.message', apartment.id)">Messages</a>
                                <a class="btn btn-dark mx-2" role="button"
                                    :href="route('dasbord.apartment.view', apartment.id)">Views</a>
                                <a class="btn btn-warning mx-2" role="button"
                                    :href="route('dashbord.apartment.sponsorship', apartment.id)">Sponsorships</a>
                                <button type="button" class="btn btn-danger" @click="destroy(apartment.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
