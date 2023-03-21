<script setup>
import { Link } from '@inertiajs/vue3';
import Jumbotron from './Jumbotron.vue';
defineProps({
    jumbo: Boolean,
})
</script>
<template>
    <nav class="navbar bg-light sticky-top shadow-sm">
        <div class="container">
            <Link class="navbar-brand" :href="route('welcome')">
            <img src="./img/boolbnb_logo.png" alt="Logo" width="150" class="d-inline-block align-text-top">
            </Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start my-bg" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">

                <div class="offcanvas-header">
                    <h2 class="offcanvas-title" id="offcanvasNavbarLabel">
                        Benvenuto
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <template v-if="$page.props.auth.user">
                            <li class="nav-item">
                                <Link :href="route('dashboard')">
                                Dashboard</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="text-danger" :href="route('logout')" method="post" as="button">
                                Logout
                                </Link>
                            </li>
                        </template>
                        <template v-else>
                            <li class="nav-item">
                                <Link :href="route('register')">
                                Register</Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('login')">
                                Login</Link>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <Jumbotron v-if="jumbo" />
</template>

<style scoped lang="scss">
.my-bg {
    background-color: #1aa1ff;
    color: white;
}

.nav-item {

    a,
    button {
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


