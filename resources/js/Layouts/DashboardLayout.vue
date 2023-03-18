<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

import dashboardNavbar from '@/Pages/Dashboard/dashboardNavbar.vue';
import dashboardSidebar from '@/Pages/Dashboard/dashboardSidebar.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="contenitore">

        <dashboardNavbar />

        <div class="d-flex">
            <div>
                <dashboardSidebar />
            </div>

            <div class="main">
                <slot />
            </div>

        </div>
    </div>
</template>

<style lang="scss" >
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;

.logo {
    width: 100px;
}

.contenitore {
    height: 100vh;
}

.main {
    height: calc(100vh - 70px);
    width: 100%;
    overflow: auto;
}
</style>
