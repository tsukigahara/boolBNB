<script setup>
import { Head, Link } from '@inertiajs/vue3';
import navBar from './navBar.vue'

defineProps({
    apartments: Array,
});
</script>

<template>
    <Head title="Boolbnb" />

    <div class="container h-100 vh-100">

        <navBar />

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
