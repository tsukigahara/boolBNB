<script setup>
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
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

        <div class="container">

            <div class="ms_navbar d-flex justify-content-between py-3">
                <h2 class="mb-3">I tuoi appartamenti</h2>

                <a class="btn btn-primary mb-3" :href="route('dashboard.apartments.create')" role="button">
                    Crea nuovo appartamento
                </a>
            </div>

            <div class="row tabella">
                <div class="col-3" v-for="apartment in apartments">
                    <div class="card mb-3">
                        <div class="d-flex justify-content-between">
                            <h5>{{ apartment.title }}</h5>
                            <div class=" dropdown">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bars"></i>
                                </a>
                                <ul class="dropdown-menu ps-2">
                                    <li>
                                        <a :href="route('dasbord.apartment.view', apartment.id)">
                                            Statistiche
                                        </a>
                                    </li>
                                    <li>
                                        <a :href="route('dasbord.apartment.message', apartment.id)">
                                            Messaggi
                                        </a>
                                    </li>

                                    <li>
                                        <a :href="route('dashbord.apartment.sponsorship', apartment.id)">
                                            sponsorizza
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div>€{{ apartment.price }}</div>
                        <div>{{ apartment.address }}</div>
                        <p class="descrizione">{{ apartment.description }}</p>



                        <div class="row pt-3">
                            <div class="col-6 mb-2 text-center">
                                <a class="btn btn-primary" :href="route('dashboard.apartments.edit', apartment.id)"
                                    role="button">
                                    Modifica
                                </a>
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

.scroll {
    overflow: auto;
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
</style>
