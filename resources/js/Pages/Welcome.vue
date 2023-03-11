<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    apartments: Array,
});
</script>

<template>
    <Head title="Boolbnb" />

    <div class="container h-100 vh-100">

        <nav class="p-3">
            <div class="d-flex justify-content-between">
                <a href="#">
                    <img class="logo" src="./img/580b57fcd9996e24bc43c513.png" alt="">
                </a>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

                <div class="dropdown">
                    <button id="btn_user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        menu
                    </button>
                    <ul class="dropdown-menu">
                        <div v-if="$page.props.auth.user">
                            <li>
                                <Link class="dropdown-item" :href="route('dashboard')">
                                Dashboard</Link>
                            </li>
                        </div>
                        <template v-else>
                            <li>
                                <Link class="dropdown-item" :href="route('register')">
                                Register</Link>
                            </li>
                            <li>
                                <Link class="dropdown-item" :href="route('login')">
                                Login</Link>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-wrap overflow-y-auto ms_padding">
            <div class="card_appa pt-2" v-for="apartment in apartments">
                <a href="">
                    <Link :href="route('show', apartment.id)">
                    <div class="pt-3">
                        <img class="img" src="./img/dl_a01597558.jpg" alt="">
                        <div class="fw-semibold">{{ apartment.title }}</div>
                        <div>{{ apartment.adress }}</div>
                        <div>€ {{ apartment.price }}</div>
                    </div>
                    </Link>
                </a>
            </div>
        </div>
    </div>
</template>


<style lang="scss">
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;

.logo {
    width: 100px;
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

.img {
    border-radius: 10px;
    width: 300px;
    height: 300px;
    object-fit: cover;
}
</style>
