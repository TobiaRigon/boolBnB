<template>
  <div>
    <div class="container-fluid">
      <div class="my_card card">
        <img
          :src="getImageUrl(apartment.main_img)"
          class="card-img-top mb-3"
          alt="Immagine dell'appartamento"
        />
        <div class="card-body">
          <div class="mb-3">
            <h5 class="pb-2 h2 card-title">{{ apartment.title }}</h5>
            <p class="card-text">{{ apartment.description }}</p>
          </div>
          <ul class="row w-100">
            <li class="col-6 py-2">
              <strong class="mr-2 h5">Ospiti Massimi:</strong>
              {{ apartment.max_guests }}
            </li>
            <li class="col-6 py-2">
              <strong class="mr-2 h5">Camere:</strong> {{ apartment.rooms }}
            </li>
            <li class="col-6 py-2">
              <strong class="mr-2 h5">Letti:</strong> {{ apartment.beds }}
            </li>
            <li class="col-6 py-2">
              <strong class="mr-2 h5">Bagni:</strong> {{ apartment.baths }}
            </li>
            <li class="col-6 py-2">
              <strong class="mr-2 h5">Indirizzo:</strong>
              {{ apartment.address }}
            </li>
            <li>
              <h3 class="mt-3 h3">Servizi:</h3>
              <ul class="list-unstyled d-flex">
                <div class="row w-100">
                  <li class="col-6 py-2" v-for="service in apartment.services">
                    <i :class="'fas ' + service.icon"></i>
                    <span class="px-3">
                      {{ service.name }}
                    </span>
                  </li>
                </div>
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
.fas {
  color: #63beec;
}
.my_card {
  max-width: 1000px;
  height: 100%;
}
</style>
