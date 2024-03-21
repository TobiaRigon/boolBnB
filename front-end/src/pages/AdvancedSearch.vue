<template>
  <div class="container">
    <div class="row">
      <div class="my-3">
        <span class="me-2">letti</span>
        <input
          v-model="letti"
          class="filtri"
          type="number"
          @input="filterApartments"
        />
        <span class="me-2">Stanze</span>
        <input class="filtri" type="number" @input="filterApartments" />
      </div>
      <div
        class="col-lg-3 col-md-6"
        v-for="apartment in store.filteredApartments"
        :key="apartment.id"
      >
        <div class="card my-3">
          <div class="card-container">
            <img
              :src="getImageUrl(apartment.main_img)"
              class="card-img-top"
              alt="..."
            />

            <h5 class="card-title p-2">{{ apartment.title }}</h5>
            <p class="card-text p-2">{{ apartment.description }}</p>
            <div class="d-flex justify-content-between">
              <router-link
                :to="'/apartments/' + apartment.id"
                class="btn btn-primary m-2"
                >APRI</router-link
              >
            </div>
          </div>
        </div>
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
import { store } from "../store";
export default {
  name: "AdvancedSearch",

  data() {
    return {
      store,
      letti: "",
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
    filtering() {
      console.log(this.letti);
    },
  },
  mounted() {
    console.log("swag:", store.filteredApartments);
  },

  filterApartments() {
    // Filtra gli appartamenti in base ai criteri selezionati
    this.filteredApartments = this.store.filteredApartments.filter(
      (apartment) => {
        // Controlla se il filtro sui letti è attivo e, se sì, se l'appartamento soddisfa il criterio
        const lettiFiltrati =
          !this.letti || apartment.beds >= parseInt(this.letti);
        // Controlla se il filtro sulle stanze è attivo e, se sì, se l'appartamento soddisfa il criterio
        const stanzeFiltrate =
          !this.stanze || apartment.rooms >= parseInt(this.stanze);
        // Restituisci true solo se entrambi i filtri sono veri
        return lettiFiltrati && stanzeFiltrate;
      }
    );
  },
  computed: {
    paginatedList() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.apartments.slice(start, end);
    },
    filteredApartments() {
      return this.store.filteredApartments.filter((apartment) => {
        return (
          (!this.letti || apartment.beds >= this.letti) &&
          (!this.stanze || apartment.rooms >= this.stanze)
        );
      });
    },
  },
};
</script>

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
li {
  list-style: none;
}
#AutoComplete {
  width: 50%;
}
#AutoComplete ul li:hover {
  background-color: rgba(0, 0, 255, 0.1);
  border: 1px solid darkgrey;
}
.filtri {
  width: 5%;
  margin-right: 20px;
}
</style>
