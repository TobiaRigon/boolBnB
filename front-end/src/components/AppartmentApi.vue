<template>
  <h1>I NOSTRI APPARTAMENTI:</h1>
  <div class="container">
    <div class="row">
      <div
        class="col-lg-3 col-md-6"
        v-for="apartment in paginatedList"
        :key="apartment.id"
      >
      <router-link
        class="card my-3"
        :class="{'sponsored-apartment': apartment.in_evidence === 1}"
        :to="formattedPath(apartment)"
      >
          <div class="card-container">
            <!-- Usa il metodo getImageUrl per ottenere il corretto percorso dell'immagine -->
            <img
              :src="getImageUrl(apartment.main_img)"
              class="card-img-top"
              alt="Immagine dell'appartamento"
            />
            <h5 class="card-title p-2">{{ apartment.title }}</h5>
            <p class="card-text p-2">{{ apartment.description }}</p>
            <div class="d-flex justify-content-between">
              <!-- <router-link
                :to="`/apartments/${apartment.id}/${apartment.title}`"
                class="btn btn-primary m-2"
                >APRI</router-link
              > --> 
            </div>
          </div>
        </router-link>
      </div>
    </div>

    <div class="btn-container">
      <div class="btn-wrapper">
        <button
          class="btn"
          type="button"
          :disabled="currentPage === 1"
          @click="changePage(-1)"
        >
          << Prev
        </button>
        <button
          class="btn"
          type="button"
          :disabled="currentPage === 4"
          @click="changePage(1)"
        >
          Next >>
        </button>
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
      perPage: 8,
      currentPage: 1,
    };
  },
  methods: {
    getImageUrl(imagePath) {
      // Verifica se il percorso restituito dal backend include il prefisso "storage"
      if (imagePath.startsWith("storage")) {
        // Costruisci il percorso completo utilizzando il percorso di base del server Laravel
        const baseUrl = "http://127.0.0.1:8000"; // Sostituisci con il tuo URL effettivo se diverso
        return `${baseUrl}/${imagePath}`;
      } else {
        // Se il percorso non include "storage", restituisci direttamente il percorso
        return imagePath;
      }
    },
    makeSlug(title) {
    return title
      .toLowerCase() // Converti tutto in minuscolo
      .replace(/\s+/g, '-') // Sostituisci gli spazi con trattini
      .replace(/[^\w\-]+/g, '') // Rimuovi tutti i caratteri non alfanumerici eccetto i trattini
      .replace(/\-\-+/g, '-'); // Sostituisci multipli trattini con un singolo trattino
  },

    changePage(num) {
      this.currentPage += num;
      console.log(this.currentPage);
    },
    formattedPath(apartment) {
    const titleFormatted = apartment.title.toLowerCase().replace(/\s+/g, '-');
    return `/apartments/${apartment.id}/${titleFormatted}`;
  }
  },
  mounted() {
    axios
    .get("http://127.0.0.1:8000/api/apartmentApi/apartments")
    .then((res) => {
      // Prima di assegnare gli appartamenti a `this.apartments`,
      // li ordini in modo che quelli sponsorizzati siano in cima.
      this.apartments = res.data.sort((a, b) => {
        // Se `a` è sponsorizzato e `b` no, `a` viene prima (ritorna -1)
        if (a.in_evidence === 1 && b.in_evidence !== 1) {
          return -1;
        }
        // Se `b` è sponsorizzato e `a` no, `b` viene prima (ritorna 1)
        if (b.in_evidence === 1 && a.in_evidence !== 1) {
          return 1;
        }
        // Se entrambi sono sponsorizzati o non lo sono, rimangono nella stessa posizione (ritorna 0)
        return 0;
      });
    })
    .catch((err) => {
      console.error(err);
    });
  },
  computed: {
    paginatedList() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.apartments.slice(start, end);
    },
  },
};
</script>

<!-- Stili rimangono invariati -->

<style scoped>
img {
  height: 180px;
  width: 100%;
  object-fit: cover;
}
img:hover {
  transform: scale(1.1);
  transition: 1.7s;
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
  height: 50%;
}
.btn-container {
  text-align: center;
}
.btn-wrapper {
  display: inline-block;
  margin: 0 auto;
}

.card-text::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}
.card-text {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
</style>
