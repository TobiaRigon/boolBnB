<script>
import axios from "axios";
export default {
  name: "HomePage",
  data() {
    return {
      searchApi: "http://127.0.0.1:8000/api/apartmentApi/search?search=",
      findApartment: "",
      apartments: [],
      perPage: 8,
      currentPage: 1,
    };
  },
  methods: {
    // Metodo per cambiare pagina
    changePage(num) {
      this.currentPage += num;
      console.log(this.currentPage);
    },
    // Metodo per eseguire la ricerca degli appartamenti
    getApartments() {
      // definisco variabile url
      let searchUrl = `${this.searchApi}${this.findApartment}`;
      // se non è vuoto aggiungo quello che trovo nell'input
      console.log(searchUrl);

      axios
        .get(searchUrl)
        .then((res) => {
          this.apartments = res.data;
          console.log(this.apartments);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    handleSearch(event) {
      event.preventDefault(); // Evita il ricaricamento della pagina
      this.getApartments();
    },
    InputChange() {
      // Esegue la ricerca degli appartamenti quando l'utente digita nel campo di ricerca
      this.getApartments();
    },
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
  },
  mounted() {
    // posso visualizzare tutti gli appartamenti
    this.getApartments();
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

<template>
  <main>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="col">
            <h1>Cerca il tuo appartamento</h1>
          </div>
        </div>
      </div>
      <form class="form-inline my-2 gap-2 d-flex" @submit="handleSearch">
        <input
          class="form-control mr-sm-2"
          type="search"
          placeholder="Cerca"
          aria-label="Search"
          v-model="findApartment"
          @input="InputChange()"
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          Cerca
        </button>
      </form>
    </div>
    <div class="container">
      <div class="row">
        <div
          class="col-lg-3 col-md-6"
          v-for="apartment in paginatedList"
          :key="apartment.id"
        >
          <router-link :to="'/apartments/' + apartment.id" class="card my-3">
            <div class="card-container">
              <img
                :src="getImageUrl(apartment.main_img)"
                class="card-img-top"
                alt="..."
              />

              <h5 class="card-title p-2">{{ apartment.title }}</h5>
              <p class="card-text p-2">{{ apartment.description }}</p>
              <div class="d-flex justify-content-between">
                <!-- <router-link
                  :to="'/apartments/' + apartment.id"
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
  </main>
</template>

<style>
.form-control {
  max-width: 50%;
  min-width: 700px;
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

.card {
  height: 500px;
  overflow: hidden;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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

.card-text::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}
.card-text {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
</style>
