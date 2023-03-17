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
    <div class="sidebar px-3">
        <div class="pt-3 fs-3">
            <a href="">
                Dashboard
            </a>
        </div>
        <div class="pt-3">
            <a href="" class="fs-3">
                My Apartments
            </a>
        </div>
    </div>
</template>

<style lang="scss">
@use "../../../scss/app.scss" as *;
@use "../../../scss/general.scss" as *;

.sidebar {
    width: 300px;
    height: calc(100vh - 70px);
    background-color: aquamarine;
}
</style>
