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

    <navBar :jumbo="true" />

    <div class="container ">


        <div class="d-flex flex-wrap overflow-y-auto ms_padding container-md row row-cols-1 mx-auto">


            <template v-for="apartment in (store.filterApplied ? store.fApartments : apartments)">
                <div class="pt-2 col-lg-3 col-md-4 col-12"
                    :class="sponsorshipArray.includes(apartment.id) ? 'order-1' : 'order-2'">

                    <Link :href="route('show', apartment.id)">
                    <div class="pt-3 prova position-relative mb-2">
                        <img class="img card-img-top" :src="'/storage/' + apartment.main_image" alt="">
                        <div class="fw-semibold pt-2 px-1 text-bold">{{ apartment.title }}</div>
                        <div class="text-secondary pt-1 px-1 lh-1">{{ apartment.square_meters }} metri quadrati </div>
                        <div class=" px-1 text-bold">{{ apartment.price }} &euro; <span class="text-secondary">notte</span>
                        </div>
                        <div class="position-absolute top-3 end-0 mx-2 mt-1 my_sponsorship fw-bolder"
                            v-show="sponsorshipArray.includes(apartment.id)">
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    </Link>
                </div>
            </template>


        </div>
    </div>
</template>


<style lang="scss">
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;

.my_sponsorship {
    color: gold;
}

.my_navbar {
    z-index: 900;
    background-color: $white;
}

:root {
    scroll-behavior: smooth;
}

.img {
    border-radius: 10px;
    height: 200px;
    object-fit: cover;
}
</style>






