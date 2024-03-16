<template>
    <h1>I NOSTRI APPARTAMENTI:</h1>
    
    <div class="container">
        <div class="row">

        
        <div class="col-lg-3 col-md-6" v-for="apartment in apartments" :key="apartment.id">
             <div class="card my-3">
                    <img :src="apartment.main_img" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ apartment.title }}</h5>
                        <p class="card-text">{{ apartment.description }}</p>
                        <div class="d-flex justify-content-between">
                            <router-link :to="'/apartments/' + apartment.id" class="btn btn-primary">APRI</router-link>
                        </div>
                    </div>
                </div>
            
    
        </div>
        
        </div>
    </div>


   

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