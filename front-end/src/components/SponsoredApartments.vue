<script>
import axios from "axios";

export default {
  name: "SponsoredApartments",
  data() {
    return {
      apartmentsInEvidence: [],
    };
  },
  mounted() {
    this.getInEvidenceApartments();
  },
  methods: {
    getInEvidenceApartments() {
      axios
        .get("http://127.0.0.1:8000/api/apartments/in-evidence")
        .then((response) => {
          this.apartmentsInEvidence = response.data;
          console.log("Appartamenti in evidenza:", this.apartmentsInEvidence);
        })
        .catch((error) => {
          console.error(
            "Errore durante il recupero degli appartamenti in evidenza:",
            error
          );
        });
    },
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

    formattedPath(apartment) {
      const titleFormatted = apartment.title.toLowerCase().replace(/\s+/g, "-");
      return `/apartments/${apartment.id}/${titleFormatted}`;
    },
  },
};
</script>

<template>
  <div class="mt-4 container-fluid text-center">
    <h2 class="my-3 h2">Appartamenti in evidenza</h2>
    <div class="apartments-in-evidence">
      <div class="row pt-3">
        <div
          class="col-lg-3 pt-3 col-md-6"
          v-for="apartment in apartmentsInEvidence"
          :key="apartment.id"
        >
          <router-link
            class="card my-3"
            :class="{ 'sponsored-apartment': apartment.in_evidence === 1 }"
            :to="formattedPath(apartment)"
          >
            <div class="card-container">
              <!-- Usa il metodo getImageUrl per ottenere il corretto percorso dell'immagine -->
              <img
                :src="getImageUrl(apartment.main_img)"
                class="card-img-top"
                alt="Immagine dell'appartamento"
              />
              <h5 class="card-title h6 p-2">{{ apartment.title }}</h5>
              <p class="card-text p-2">{{ apartment.description }}</p>
              <div class="d-flex justify-content-between"></div>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.apartments-in-evidence {
  width: 90%;
  margin: 0 auto; /* Imposta i margini automatici per centrare il div */
}
.card {
  height: 500px;
  overflow: hidden;
}
.card-container {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}

.card-text {
  overflow-y: auto;
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
.card-text::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}
img {
  height: 180px;
  width: 100%;
  object-fit: cover;
}
img:hover {
  transform: scale(1.1);
  transition: 1.7s;
}
a {
  text-decoration: none;
}
.card-text::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}
</style>
