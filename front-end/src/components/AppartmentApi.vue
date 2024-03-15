<template>
    <h1>I NOSTRI APPARTAMENTI:</h1>
    
    <ul>
        <li v-for="apartment in apartments" :key="apartment.id">
            <h4>{{ apartment.title }}</h4>
            <p>{{ apartment.description }}</p>
        </li> 
    </ul>
</template>

<script>
import axios from "axios";

export default {
    name: "AppartmentApi",
    data() {
        return {
            apartments: [],

        };
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/api/apartmentApi/apartments")
            .then((res) => {
            
                    this.apartments = res.data;
                    
            })
            .catch((err) => {
                console.error(err);
            });
    },
};
</script>