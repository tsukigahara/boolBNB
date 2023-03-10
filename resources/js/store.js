import { reactive } from 'vue';

export const store = reactive({

    geocode: "http://127.0.0.1:8000/api/geocode",
    searchAPI: "http://127.0.0.1:8000/api/apartments",
    servicesAPI: "http://127.0.0.1:8000/api/services",
    always: true,
    never: false,
    allServices: [],
    filterApplied: false,
    searchQuery: "",
    searchRadius: "",
    searchRooms:"",
    searchBeds:"",
    searchServices: [],
    fApartments: [],



}); 
