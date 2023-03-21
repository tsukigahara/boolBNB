<script setup>
import { Link } from '@inertiajs/vue3';
import Jumbotron from './Jumbotron.vue';
defineProps({
    jumbo: Boolean,
})
</script>
<template>
    <nav class="p-3">
        <div class="d-flex justify-content-between align-items-center">
            <a :href="route('welcome')">
                <img class="logo" src="./img//bool.png" alt="">
            </a>

            <div class="dropdown">
                <button class="btn_user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    menu
                </button>
                <ul class="dropdown-menu">
                    <div v-if="$page.props.auth.user">
                        <li>
                            <Link class="dropdown-item" :href="route('dashboard')">
                            Dashboard</Link>
                        </li>
                    </div>
                    <template v-else>
                        <li>
                            <Link class="dropdown-item" :href="route('register')">
                            Register</Link>
                        </li>
                        <li>
                            <Link class="dropdown-item" :href="route('login')">
                            Login</Link>
                        </li>
                    </template>
                </ul>
            </div>
        </div>

        <Jumbotron v-if="jumbo" />
    </nav>
</template>

<style scoped lang="scss">
.logo {
    width: 20%;
}

.btn_user {
    padding: 5px;
    border-radius: 40px;
    border: 1px solid grey;
}
</style>


