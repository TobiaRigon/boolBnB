<template>
    <h1>DETTAGLIO APPARTAMENTO:</h1>
    
    <div class="container">
        <div class="row">

        
        <div class="col-lg-3 col-md-6">
             <div class="card my-3">
                    <img :src="apartment.main_img" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ apartment.title }}</h5>
                        <p class="card-text">{{ apartment.description }}</p>
                        <div class="d-flex justify-content-between">
                            
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
    name: "ApartmentDetailApi",
    data() {
        return {
            apartment: {},

        };
    },
    mounted() {
        
        const apartmentId = this.$route.params.id;
        axios.get(`http://127.0.0.1:8000/api/apartmentApi/apartments/${apartmentId}`)

            .then((res) => {
            
                    this.apartment = res.data;
                    
            })
            .catch((err) => {
                console.error(err);
            });
    },
};
</script>