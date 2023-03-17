<script setup>
import { Head, Link } from '@inertiajs/vue3';
import navBar from './navBar.vue';
import { store } from '../store';

defineProps({
    apartments: Array,
    sponsorshipArray: Array
});

</script>


<template>
    <Head title="Boolbnb" />

    <div class="container h-100 vh-100">

        <navBar />
        <div class="d-flex flex-wrap overflow-y-auto ms_padding">


            <template v-for="apartment in (store.filterApplied ? store.fApartments : apartments)">
                <a href="" class="card_appa pt-2" :class="sponsorshipArray.includes(apartment.id) ? 'order-1' : 'order-2'">
                    <Link :href="route('show', apartment.id)">
                    <div class="pt-3 prova">
                        <img class="img" src="./img/dl_a01597558.jpg" alt="">
                        <div class="fw-semibold">{{ apartment.title }}</div>
                        <div>{{ apartment.adress }}</div>
                        <div>€ {{ apartment.price }}</div>
                        <div class="sponsor" v-show="sponsorshipArray.includes(apartment.id)">sponsorizzato</div>
                    </div>
                    </Link>
                </a>
            </template>


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
    position: relative;
}

.img {
    border-radius: 10px;
    width: 300px;
    height: 300px;
    object-fit: cover;
}

.prova {
    position: relative;
}

.sponsor {
    position: absolute;
    top: 30px;
    left: 5px;
    background-color: gold;
    border-radius: 10px;
    padding: 5px;
}
</style>






