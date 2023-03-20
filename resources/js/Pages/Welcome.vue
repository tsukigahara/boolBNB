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

    <div class="container ">

        <navBar class="position-sticky top-0 my_navbar"/>

        <div class="d-flex flex-wrap overflow-y-auto ms_padding container-md row row-cols-1 mx-auto">


            <template v-for="apartment in (store.filterApplied ? store.fApartments : apartments)" >
                <a href="" class="card_appa pt-2 col-lg-3 col-md-4 col-12" v-if="sponsorshipArray.includes(apartment.id)">
                    <Link :href="route('show', apartment.id)">
                    <div class="pt-3 prova position-relative mb-2">
                        <img class="img card-img-top" src="./img/dl_a01597558.jpg" alt="">
                        <div class="fw-semibold pt-2 px-1 text-bold">{{ apartment.title }}</div>
                        <div class="text-secondary pt-1 px-1 lh-1">{{ apartment.square_meters }} metri quadrati </div>
                        <div class=" px-1 text-bold">{{ apartment.price }} &euro; <span class="text-secondary">notte</span> </div>
                        <div class="position-absolute top-3 end-0 mx-2 mt-1 border border-2 rounded-bottom px-2 my_sponsorship fw-bolder  " v-show="sponsorshipArray.includes(apartment.id)">Sponsorizzato</div>
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

.my_sponsorship {
    color: $white;
}

.my_navbar {
    z-index: 900;
    background-color: $white;
}

:root {
    scroll-behavior: smooth;
}

// .card_appa {
//     width: calc((100% / 4) - 10px);
//     margin: 5px;
//     border-radius: 40px;
//     position: relative;
// }

// .img {
//     border-radius: 10px;
//     width: 300px;
//     height: 300px;
//     object-fit: cover;
// }

// .prova {
//     position: relative;
// }

// .sponsor {
//     position: absolute;
//     top: 30px;
//     left: 5px;
//     background-color: gold;
//     border-radius: 10px;
//     padding: 5px;
// }
</style>






