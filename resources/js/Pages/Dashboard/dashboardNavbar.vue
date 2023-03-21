<script setup>
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';


// props
defineProps({

});

</script>

<template>
    <nav class="navbar bg-light sticky-top">
        <div class="container">
            <Link class="navbar-brand" :href="route('welcome')">
            <img src="../../../js/Pages/img/boolbnb_logo.png" alt="Logo" width="150" class="d-inline-block align-text-top">
            </Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-top my-bg" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="container">

                    <div class="offcanvas-header">
                        <h2 class="offcanvas-title" id="offcanvasNavbarLabel">Dashboard</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <Link :href="route('dashboard.apartments')">
                                Appartamenti
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('dashboard')">
                                Messaggi
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('profile.edit')"> Profilo </Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('logout')" method="post">
                                Logout
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<style lang="scss" scoped>
@use "../../../scss/app.scss" as *;
@use "../../../scss/general.scss" as *;

.my-bg {
    background-color: #1aa1ff;
    color: white;
}

.nav-item {
    a {
        font-size: 24px;
        font-weight: 700;
        color: white;

        &:hover {
            background-color: rgb(255, 255, 255);
            color: #1aa1ff;
        }
    }

}
</style>