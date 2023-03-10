<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Boolbnb" />

    <div class="container">

        <nav class="pt-3">

            <div v-if="canLogin">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')">
                Dashboard</Link>

                <template v-else>
                    <div class="d-flex justify-content-between">
                        <a href="#">
                            <!-- da inserire logo immagine -->
                            logo
                        </a>

                        <div class="dropdown">
                            <button id="btn_user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                User
                            </button>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
                                        <Link :href="route('login')">
                                        Log in</Link>
                                    </a></li>
                                <li><a class="dropdown-item" href="#">
                                        <Link v-if="canRegister" :href="route('register')">
                                        Register</Link>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </template>
            </div>
        </nav>
    </div>
    <hr>
</template>

<style lang="scss">
@use "../../scss/app.scss" as *;
@use "../../scss/general.scss" as *;

#btn_user {
    padding: 5px;
    border-radius: 40px;
    border: 1px solid grey;
}
</style>
