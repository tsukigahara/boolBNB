<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

// props
defineProps({
    apartments: Array,
    sponsorshipArray: Array
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

        <div class="container">

            <div class="ms_navbar d-flex justify-content-between align-items-center">
                <h2>I tuoi appartamenti</h2>

                <Link class="btn btn-primary" :href="route('dashboard.apartments.create')" role="button">
                Crea nuovo appartamento
                </Link>
            </div>

            <div class="row tabella">
                <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12" v-for="apartment in apartments">
                    <div class="card mb-3">
                        <div class="d-flex justify-content-between">
                            <h5>{{ apartment.title }}</h5>
                            <div v-show="sponsorshipArray.includes(apartment.id)">
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class=" dropdown">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bars"></i>
                                </a>
                                <ul class="dropdown-menu ps-2">
                                    <li>
                                        <Link :href="route('dasbord.apartment.view', apartment.id)">
                                        Statistiche
                                        </Link>
                                    </li>
                                    <li>
                                        <Link :href="route('dasbord.apartment.message', apartment.id)">
                                        Messaggi
                                        </Link>
                                    </li>

                                    <li>
                                        <Link :href="route('dashbord.apartment.sponsorship', apartment.id)">
                                        sponsorizza
                                        </Link>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div>
                            <img :src="'/storage/' + apartment.main_image" :alt="apartment.title">
                        </div>
                        <div>€{{ apartment.price }}</div>
                        <div>{{ apartment.address }}</div>



                        <div class="row pt-3">
                            <div class="col-6 mb-2 text-center">
                                <Link class="btn btn-primary" :href="route('dashboard.apartments.edit', apartment.id)"
                                    role="button">
                                Modifica
                                </Link>
                            </div>
                            <div class="col-6 mb-2 text-center">
                                <button type="button" class="btn btn-danger" @click="destroy(apartment.id)">
                                    Elimina
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </DashboardLayout>
</template>

<style lang="scss" scoped>
.container {
    height: calc(100vh - 70px);
}

.card {
    padding: 10px;
}

.descrizione {
    height: 60px;
}

.ms_navbar {
    height: 85px;
}

.tabella {
    height: calc(100% - 85px);
    overflow: auto;
}

.img {
    border-radius: 10px;
    width: 300px;
    height: 200px;
    object-fit: cover;
}
</style>
