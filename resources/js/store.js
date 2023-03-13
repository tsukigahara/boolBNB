import { reactive } from 'vue';

export const store = reactive({

    geocode: "http://127.0.0.1:8000/api/geocode/",
    searchAPI: "http://127.0.0.1:8000/api/apartments/",
    filterApplied: false,
    searchQuery: "",
    fApartments: [],



}); 
