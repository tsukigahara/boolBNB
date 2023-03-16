<script setup>
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';

// props
defineProps({

});

</script>

<template>
    <nav class="navbar d-flex justify-content-between ">

        <div class="container d-flex justify-content-between ">
            <div>
                <Link :href="route('welcome')">
                <img class="logo" src="../../../js/Pages/img/580b57fcd9996e24bc43c513.png" alt="Airbnb">
                </Link>
            </div>

            <div>
                <li class="nav-item dropdown account">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ $page.props.auth.user.name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <DropdownLink :href="route('profile.edit')"> Profilo </DropdownLink>
                        </li>
                        <li>
                            <DropdownLink :href="route('logout')" method="post">
                                Log Out
                            </DropdownLink>
                        </li>

                    </ul>
                </li>
            </div>
        </div>

    </nav>
</template>

<style lang="scss">
@use "../../../scss/app.scss" as *;
@use "../../../scss/general.scss" as *;


.navbar {
    height: 70px;
    // background-color: red;
    width: 100%;
}

.logo {
    width: 100px;
}

.account {
    border: 1px solid grey;
    padding: 5px;
    border-radius: 20px;
}
</style>