<template>
  <div>
    <h1>DETTAGLI APPARTAMENTO:</h1>

    <div class="container d-flex justify-content-center">
      <div class="card">
        <img :src="apartment.main_img" class="card-img-top" alt="..." />
        <div class="card-body">
          <h5 class="card-title">{{ apartment.title }}</h5>
          <p class="card-text">{{ apartment.description }}</p>
          <ul>
            <li><strong>Ospiti Massimi:</strong> {{ apartment.max_guests }}</li>
            <li><strong>Camere:</strong> {{ apartment.rooms }}</li>
            <li><strong>Letti:</strong> {{ apartment.beds }}</li>
            <li><strong>Bagni:</strong> {{ apartment.baths }}</li>
            <li><strong>Indirizzo:</strong> {{ apartment.address }}</li>
            <li><strong>Servizi:</strong>
              <ul class="list-unstyled">
                <li v-for="service in apartment.services">
                  <i :class="'fas ' + service.icon"></i> {{ service.name }}
                </li>
              </ul>
            </li>
          </ul>
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
    axios
      .get(`http://127.0.0.1:8000/api/apartmentApi/apartments/${apartmentId}`)
      .then((res) => {
        this.apartment = res.data;
      })
      .catch((err) => {
        console.error(err);
      });
  },
};
</script>

<style scoped>
.card {
  max-width: 1000px;
}
</style>
