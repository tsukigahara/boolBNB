<script>

import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { store } from '../store';


export default {
    name: "navBar",
    props: {
    },
    data() {
        return {
            store,

        }
    },
    methods: {
        searchApartments(element, range) {
            const fullSearchAPI = `${store.searchAPI}/${element}/${range}`;
            axios.get(fullSearchAPI)
                .then(res => {
                    store.fApartments = res.data.response.data.filteredApartments;
                    console.log(store.fApartments)
                    console.log(fullSearchAPI)
                    console.log(store.searchServices)
                    console.log(store.searchBeds)
                    console.log(store.searchRooms)
                });
            store.filterApplied = true;
        },
    },
    mounted() {
        axios.get(store.servicesAPI)
            .then(res => {
                store.allServices = res.data.response.data.services

            })
    }

}
</script>
<!-- Servizi DEF se 0 = any | numero di stanze se 0 = any | numero di letti se 0 = any

-->
<template>
    <nav class="p-3">
        <div class="d-flex justify-content-between">
            <a :href="route('welcome')">
                <img class="logo" src="./img/580b57fcd9996e24bc43c513.png" alt="">
            </a>

            <div class="d-flex" role="search">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                    v-model="store.searchQuery">
                <select class="form-control mx-2" name="radius" id="radius-select" v-model="store.searchRadius">
                    <option value="" disabled selected>Seleziona raggio</option>
                    <option value="20">20km</option>
                    <option value="50">50km</option>
                    <option value="100">100km</option>
                    <option value="300">300km</option>
                    <option value="10000">10000km</option>
                </select>
                <div v-if="store.searchServices !== []">
                    <div class="dropdown">
                        <button class="form-control dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Servizi
                        </button>
                        <ul class="dropdown-menu p-1">
                            <li v-for="service in store.allServices" :key="service.id">
                                <input type="checkbox" :id="'service-' + service.id" :value="service.id"
                                    v-model="store.searchServices">
                                <label :for="'service- ' + service.id">
                                    {{ service.name }}
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <input class="form-control mx-2" type="number" placeholder="Camere" aria-label="Rooms"
                    v-model="store.searchRooms">
                <input class="form-control me-2" type="number" placeholder="Letti" aria-label="Beds"
                    v-model="store.searchBeds">
                <button class="btn btn-outline-success" type="submit"
                    @click.prevent="searchApartments(store.searchQuery, store.searchRadius)">Search</button>
            </div>

            <div class="dropdown">
                <button class="btn_user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    menu
                </button>
                <ul class="dropdown-menu">
                    <div v-if="$page.props.auth.user">
                        <li>
                            <a class="dropdown-item" :href="route('dashboard')">
                                Dashboard</a>
                        </li>
                    </div>
                    <template v-else>
                        <li>
                            <a class="dropdown-item" :href="route('register')">
                                Register</a>
                        </li>
                        <li>
                            <a class="dropdown-item" :href="route('login')">
                                Login</a>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped lang="scss">
.logo {
    width: 100px;
}

.btn_user {
    padding: 5px;
    border-radius: 40px;
    border: 1px solid grey;
}

.ms_btn {
    border: 1px solid grey;

}
</style>




