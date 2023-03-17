<script setup>
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';

// props
defineProps({

});

</script>

<template>
    <nav class="navbar">

        <div class="container d-flex justify-content-between ">

            <div class="row">
                <div class="col-2">
                    <Link :href="route('welcome')">
                    <img class="logo" src="../../../js/Pages/img/580b57fcd9996e24bc43c513.png" alt="Airbnb">
                    </Link>
                </div>
                <div class="col-10 text-end">
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
            <div>

            </div>

            <div>

            </div>
        </div>

    </nav>
</template>

<style lang="scss">
@use "../../../scss/app.scss" as *;
@use "../../../scss/general.scss" as *;


.navbar {
    height: 70px;
    background-color: #0079b0;
    width: 100%;
}

.logo {
    width: 100%;
}

.account {
    border: 1px solid grey;
    padding: 5px;
    border-radius: 20px;
}
</style>