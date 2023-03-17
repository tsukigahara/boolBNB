<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

// props
defineProps({

});

</script>

<template>
    <div class="sidebar">
        <div class="container">
            <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="fs-5 white">
                <div class="row pt-5">
                    <div class="col-3 text-center fs-5 ">
                        <i class="fa-solid fa-diagram-project"></i>
                    </div>
                    <div class="col-9">
                        Dashboard
                    </div>
                </div>
            </NavLink>

            <NavLink :href="route('dashboard.apartments')" :active="route().current('dashboard.apartments')"
                class="fs-5 white">
                <div class="row pt-5">
                    <div class="col-3 text-center fs-5 white">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div class="col-9">
                        My Apartments
                    </div>
                </div>
            </NavLink>
        </div>
    </div>
</template>

<style lang="scss">
@use "../../../scss/app.scss" as *;
@use "../../../scss/general.scss" as *;

.sidebar {
    width: 300px;
    height: calc(100vh - 70px);
    background-color: #fd8ba0;
    margin: 0 auto;
}

white {
    color: white;

    &:hover {
        color: red;
    }
}
</style>
