<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<script>
import { onMounted } from 'vue';
import { store } from '../store';
import axios from 'axios';

export default {
    name: "navBar",
    props: {
    },
    data() {
        return {
            store,
            showDropdown: false,

        }
    },
    methods: {
        searchApartments(element, range) {
            let elementSearch = element.replace(' ', '+');
            const fullSearchAPI = `${store.searchAPI}/${elementSearch}/${range}`;
            axios.get(fullSearchAPI)
                .then(res => {
                    store.fApartments = res.data.response.data.filteredApartments.map(obj => ({
                        ...obj,
                        passesFilter: true,
                        serviceRelevancy: 0
                    }));
                    store.filterApplied = true;
                    this.filter();
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
        filter() {
            store.advancedfApartments = [];
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
        },
        checkInputLength() {
            if (this.shouldMakeApiCall) {
                this.searchAutocomplete(store.searchQuery)
            }
            this.showDropdown = true;
        },
        searchAutocomplete(element) {
            let query = element.replace(/\s/g, '+');
            const fullAutocompleteAPI = `${store.autocompleteAPI}/${query}`;
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
            store.searchQuery = suggestion.replace('+', ' ');
            this.showDropdown = false;
        },
        test(elem) {
            console.log(elem)
        }


    },
    computed: {
        shouldMakeApiCall() {
            return store.searchQuery.length >= 2
        },
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



<template>
    <div class="position-relative container_jumbo pt-4 mb-3 row">

        <div class="d-flex flex-column ms_img align-items-center p-4  col-12">
            <h1 class="title pb-2">Dove vuoi andare?</h1>

            <div class="d-flex justify-content-center ms_search row" role="search">
                <div class="col-12 col-md-6">

                    <div class="input-group  ">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                        v-model="store.searchQuery" @input="checkInputLength()">
                        <button class="btn btn-success" type="submit"
                        @click.prevent="searchApartments(store.searchQuery, store.searchRadius)"><i
                        class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
                        <div v-if="showDropdown" class="campiRicerca">
                            <ul v-if="store.searchQuery ? showDropdown = true : showDropdown = false">
                                <li class="pulsante" v-for="elem in store.autocompleteArray?.suggestions?.results"
                                @click="pickSuggestion(`${elem.address.freeformAddress} ${elem.address.countrySubdivision} ${elem.address.country}`)">
                                {{ elem.address.freeformAddress }}, {{ elem.address.countrySecondarySubdivision }}, {{
                                    elem.address.countrySubdivision }}, {{ elem.address.country }}
                            </li>
                        </ul>
                    </div>
                    <Link :href="route('filteredPage')" v-if="!store.isOnFiltered" class="btn btn-success ms-2"><i
                        class="fa-solid fa-sliders" style="color: #ffffff;"></i>
                    </Link>
                </div>
            </div>
                



            </div>
            <div class="container-fluid">

            
            <div class="d-flex pt-3 row">
                <div class="col-12 col-md-3">

                    <select class="form-control servizi " name="radius" id="radius-select" v-model="store.searchRadius"
                    v-if="store.isOnFiltered">
                    <option value="" disabled selected>raggio</option>
                    <option value="20">20km</option>
                    <option value="50">50km</option>
                    <option value="100">100km</option>
                    <option value="300">300km</option>
                    <option value="10000">10000km</option>
                </select>
            </div>
                <div v-if="store.searchServices !== [] && store.isOnFiltered" class="col-12 col-md-3">
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
                <div class="col-12 col-md-3">

                    <input class="form-control servizi " type="number" placeholder="Camere" aria-label="Rooms"
                    v-model="store.searchRooms" v-if="store.isOnFiltered">
                </div>
                <div class="col-12 col-md-3">
                    <input class="form-control  servizi " type="number" placeholder="Letti" aria-label="Beds"

                    v-model="store.searchBeds" v-if="store.isOnFiltered">
                </div>
            </div>
                </div>
        </div>


    </div>
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

.search {
    width: 30vw;

}

.ms_btn {
    border: 1px solid grey;
}

.campiRicerca {
    border: 1px solid rgb(203, 203, 203);
    margin-top: 38px;
    padding: 10px;
    z-index: 100;
    position: fixed;
    background-color: white;

    ul {
        padding: 0;
    }
}

.pulsante:hover {
    background-color: rgb(217, 217, 217);

}

// .servizi {
//     width: 50%;
// }

.container_jumbo {
    height: 180px;
    width: 100%;
    object-fit: contain;

    .jumbo {
        height: 100%;
        width: 100%;
        border-radius: 40px;
        object-fit: cover;
    }

    .title {
        color: white;
    }

    .ms_search {
        width: 100%;
        position: relative;
    }

    // .ms_input {
    //     width: 40%;
    // }


}

.ms_img {
    background-image: url('./img/vista-aerea-di-kelingking-beach-nell-isola-di-nusa-penida-bali-in-indonesia.jpg');
    border-radius: 20px;
    background-size: cover;
    background-position: 50%;
}
</style>




