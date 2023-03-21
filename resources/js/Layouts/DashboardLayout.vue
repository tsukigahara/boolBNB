<script setup>
import { ref } from 'vue';

import dashboardNavbar from '@/Pages/Dashboard/dashboardNavbar.vue';
import dashboardSidebar from '@/Pages/Dashboard/dashboardSidebar.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <dashboardNavbar />
    <div class="container-fluid">
        <div class="main">
            <slot />
        </div>
    </div>
</template>

<style lang="scss" >
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;
</style>
