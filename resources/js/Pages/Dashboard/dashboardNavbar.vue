<script setup>
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';

// props
defineProps({

});

</script>

<template>
    <nav class="navba d-flex align-items-center">

        <div class="navLogo ">
            <Link :href="route('welcome')" class="d-flex justify-content-center">
            <img class="logo" src="../../../js/Pages/img/bool.png" alt="Airbnb">
            <img class="icona" src="../../Pages/img/Icona.png" alt="">
            </Link>
        </div>

        <div class="d-flex justify-content-end width me-3">
            <li class="nav-item dropdown account ">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    </nav>
</template>

<style lang="scss" scoped>
@use "../../../scss/app.scss" as *;
@use "../../../scss/general.scss" as *;


.navba {
    height: 70px;
    background-color: white;
    border-bottom: 2px solid blue;
}

.navLogo {
    width: 300px;
}

.width {
    width: calc(100vw - 300px);
}

.logo {
    width: 60%;
    text-align: center;
}

.icona {
    width: 50%;
    display: none;
}


.account {
    border: 1px solid grey;
    width: auto;
    padding: 5px;
    border-radius: 20px;
    background-color: white;
}

@media screen and (max-width: 768px) {

    .navLogo {
        width: 90px;
    }

    .logo {
        display: none;
    }

    .icona {
        display: inline;
    }

    .width {
        width: calc(100vw - 90px);
    }
}
</style>