<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    apartments: Array,
});
</script>

<template>
    <Head title="Boolbnb" />

    <div class="container special">

        <nav class="py-3">

            <div v-if="canLogin">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')">
                Dashboard</Link>

                <template v-else>
                    <div class="d-flex justify-content-between">
                        <a href="#">
                            <!-- da inserire logo immagine -->
                            logo
                        </a>

                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>

                        <div class="dropdown">
                            <button id="btn_user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                User
                            </button>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
                                        <Link :href="route('login')">
                                        Log in</Link>
                                    </a></li>
                                <li><a class="dropdown-item" href="#">
                                        <Link v-if="canRegister" :href="route('register')">
                                        Register</Link>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </template>
            </div>
        </nav>

        <div class="d-flex flex-wrap overflow-y-auto">
            <div class="card_appa pt-2" v-for="apartment in apartments">
                <img src="./img/dl_a01597558.jpg" alt="">
                <div class="pt-3">
                    <div class="fw-semibold">{{ apartment.title }}</div>
                    <div>{{ apartment.address }}</div>
                    <div>€ {{ apartment.price }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;

.special {
    height: 100vh;
}

.ms_navbar {
    position: fixed;
}

#btn_user {
    padding: 5px;
    border-radius: 40px;
    border: 1px solid grey;
}

.card_appa {
    width: calc((100% / 4) - 10px);
    margin: 5px;
    border-radius: 40px;
}

img {
    border-radius: 10px;
    width: 300px;
    height: 300px;
    object-fit: cover;
}
</style>
