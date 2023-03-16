import { reactive } from 'vue';

export const store = reactive({

    geocode: "http://127.0.0.1:8000/api/geocode",
    searchAPI: "http://127.0.0.1:8000/api/apartments",
    servicesAPI: "http://127.0.0.1:8000/api/services",
    isOnFiltered: false,
    allServices: [],
    filterApplied: false,
    searchQuery: "",
    searchRadius: "",
    searchRooms:"",
    searchBeds:"",
    searchServices: [],
    fApartments: [],
    advancedfApartments: [],
    autocompleteAPI: "http://127.0.0.1:8000/api/autocomplete",
    autocompleteArray: [],
    createAddress: "",

}); 
