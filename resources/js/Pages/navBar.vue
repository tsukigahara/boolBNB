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
            store.advancedfApartments = [];
            const fullSearchAPI = `${store.searchAPI}/${element}/${range}`;
            axios.get(fullSearchAPI)
                .then(res => {
                    store.fApartments = res.data.response.data.filteredApartments.map(obj => ({
                        ...obj,
                        passesFilter: true,
                        serviceRelevancy: 0
                    }));
                    store.filterApplied = true;
                    store.fApartments.forEach(element => {
                        if ((element.rooms < parseInt(store.searchRooms)) || (element.beds < parseInt(store.searchBeds))) {
                            element.passesFilter = false;
                        }
                        else {

                            if (store.searchServices.length < 1) {
                                element.serviceRelevancy++;
                            }
                            else {
                                element.services.forEach(service => {
                                    if (store.searchServices.includes(service.id)) {
                                        element.serviceRelevancy++;
                                    }
                                });
                            }

                        }
                        if (element.serviceRelevancy < 1) {
                            element.passesFilter = false;
                        }
                        if (element.passesFilter == true) {
                            store.advancedfApartments.push(element)
                        }

                    });
                    console.log(store.fApartments)
                });
        },
        checkFiltered() {
            let pageURL = this.$page.url

            if (pageURL == '/filtered') {
                store.isOnFiltered = true
            } else {
                store.isOnFiltered = false
                store.searchRadius = 20
            }
        },
        checkInputLength() {
            if (this.shouldMakeApiCall) {
                this.searchAutocomplete(store.searchQuery)
            }
        },
        searchAutocomplete(element) {
             const fullAutocompleteAPI = `${store.autocompleteAPI}/${element}`;
             axios.get(fullAutocompleteAPI)
                .then(res => {
                    store.autocompleteArray = res.data.response.data
                    console.log(store.autocompleteArray)
                })
                .catch(err => {
                    console.log(err)
                });
        },
        pickSuggestion(suggestion) {
            store.searchQuery = suggestion;

        },
        test(elem) {
            console.log(elem)
        }


    },
    computed: {
        shouldMakeApiCall() {
            return store.searchQuery.length >= 4
        }
    },
    mounted() {
        axios.get(store.servicesAPI)
            .then(res => {
                store.allServices = res.data.response.data.services

            })
        this.checkFiltered()

    }

}
</script>
<!-- Servizi DEF se 0 = any | numero di stanze se 0 = any | numero di letti se 0 = any

-->
<template>
    <!-- <button @click="test(this.store.autocompleteArrayTemplate)">TEST</button> -->
    <nav class="p-3">
        <div class="d-flex justify-content-between">
            <a :href="route('welcome')">
                <img class="logo" src="./img/580b57fcd9996e24bc43c513.png" alt="">
            </a>

            <div class="d-flex" role="search">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                    v-model="store.searchQuery"
                    @input="checkInputLength()"
                >
                <div
                    v-if="shouldMakeApiCall"
                >
                    <ul>
                        <li v-for="elem in store.autocompleteArray.suggestions?.results" @click="pickSuggestion(`${elem.address.freeformAddress}+${elem.address.countrySecondarySubdivision}+${elem.address.countrySubdivision}+${elem.address.country}`) ">
                            {{ elem.address.freeformAddress }} | {{ elem.address.countrySecondarySubdivision }} | {{ elem.address.countrySubdivision }} | {{ elem.address.country }}
                        </li>
                    </ul>
                </div>
                <select class="form-control mx-2" name="radius" id="radius-select" v-model="store.searchRadius"
                    v-if="store.isOnFiltered"
                >
                    <option value="" disabled selected>Seleziona raggio</option>
                    <option value="20">20km</option>
                    <option value="50">50km</option>
                    <option value="100">100km</option>
                    <option value="300">300km</option>
                    <option value="10000">10000km</option>
                </select>
                <div v-if="store.searchServices !== [] && store.isOnFiltered">
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
                    v-model="store.searchRooms"
                    v-if="store.isOnFiltered">
                <input class="form-control me-2" type="number" placeholder="Letti" aria-label="Beds"
                    v-model="store.searchBeds"
                    v-if="store.isOnFiltered">
                <button class="btn btn-outline-success" type="submit"
                    @click.prevent="searchApartments(store.searchQuery, store.searchRadius)">Search</button>
                <!-- <button @click.prevent="advancedSearchApartments(store.searchQuery, store.searchRadius)" class="btn btn-outline-success">AdS</button> -->

                <a :href="route('filteredPage')" 
                    v-if="!store.isOnFiltered"
                >
                    <button class="btn btn-outline-success">Advanced Search</button>
                </a> 
                
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




