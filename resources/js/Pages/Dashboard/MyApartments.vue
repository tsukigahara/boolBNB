<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

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

    <DashboardLayout>

        <div class="container my-4 shadow p-3 rounded overflow-scroll">
            <h1>I tuoi appartamenti</h1>
            <Link class="btn btn-primary" :href="route('dashboard.apartments.create')" role="button">
            Crea annuncio
            </Link>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 my-3 overflow-scroll">
                <div class="col" v-for="apartment in apartments">
                    <div class="card h-100 shadow">
                        <img :src="'/storage/' + apartment.main_image" :alt="apartment.title">
                        <div class="card-body">
                            <h5 class="card-title">{{ apartment.title }}</h5>
                            <p class="card-text">{{ apartment.price }}€</p>
                            <p class="card-text">{{ apartment.address }}</p>
                        </div>
                        <div class="card-footer bg-body">
                            <Link class="btn btn-light mr-1" :href="route('dashboard.apartments.edit', apartment.id)"
                                role="button">
                            Modifica
                            </Link>
                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Altro
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <Link class="dropdown-item" :href="route('dasbord.apartment.view', apartment.id)">
                                        Statistiche
                                        </Link>
                                    </li>
                                    <li>
                                        <Link class="dropdown-item"
                                            :href="route('dasbord.apartment.message', apartment.id)">
                                        Messaggi
                                        </Link>
                                    </li>

                                    <li>
                                        <Link class="dropdown-item"
                                            :href="route('dashbord.apartment.sponsorship', apartment.id)">
                                        Sponsorship
                                        </Link>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item text-danger"
                                            @click="destroy(apartment.id)">
                                            Elimina
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </DashboardLayout>
</template>

<style lang="scss" scoped></style>
