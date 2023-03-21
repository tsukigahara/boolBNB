<script setup>
import dashboardNavbar from '@/Pages/Dashboard/dashboardNavbar.vue';
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
