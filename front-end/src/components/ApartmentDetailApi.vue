<template>
  <div>
    <h1>DETTAGLI APPARTAMENTO:</h1>

    <div class="container d-flex justify-content-center">
      <div class="my_card card">
        <img
          :src="getImageUrl(apartment.main_img)"
          class="card-img-top"
          alt="Immagine dell'appartamento"
        />
        <div class="card-body">
          <div class="mb-3">
            <h5 class="card-title">{{ apartment.title }}</h5>
            <p class="card-text">{{ apartment.description }}</p>
          </div>
          <ul>
            <li><strong>Ospiti Massimi:</strong> {{ apartment.max_guests }}</li>
            <li><strong>Camere:</strong> {{ apartment.rooms }}</li>
            <li><strong>Letti:</strong> {{ apartment.beds }}</li>
            <li><strong>Bagni:</strong> {{ apartment.baths }}</li>
            <li><strong>Indirizzo:</strong> {{ apartment.address }}</li>
            <li>
              <strong>Servizi:</strong>
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
  methods: {
    getImageUrl(imagePath) {
      // Controlla se il percorso dell'immagine sembra essere un URL completo
      if (
        imagePath &&
        (imagePath.startsWith("http://") || imagePath.startsWith("https://"))
      ) {
        return imagePath;
      }
      // Altrimenti, costruisci il percorso completo utilizzando il percorso di base del server Laravel
      const baseUrl = "http://127.0.0.1:8000"; // Modifica con il tuo URL effettivo se diverso
      return `${baseUrl}/${imagePath}`;
    },
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
.my_card {
  max-width: 1000px;
  height: 100%;
}
</style>
