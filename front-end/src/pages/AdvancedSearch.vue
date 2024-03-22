<template>
  <h1>RISULTATI RICERCA:</h1>
  <div v-for="servizio in store.services" :key="servizio.id" class="ms-4 mb-1">
    <input
      type="checkbox"
      v-model="servizio.selected"
      @change="filtering(servizio.id)"
    />
    <label class="ms-2">{{ servizio.name }}</label>
  </div>
  <div class="container mt-5">
    <div class="row">
      <div class="input-group mb-3">
        <input
          type="range"
          class="form-range raggio me-5"
          min="1"
          max="100"
          step="1"
          v-model="store.radius"
          @input="changeRadius()"
        />
        <span class="input-group-text kilometri">{{ store.radius }} km</span>
      </div>
      <div class="my-3">
        <span class="me-2">Letti</span>
        <input
          v-model="letti"
          class="filtri"
          type="number"
          @input="filtering()"
        />
        <span class="me-2">Stanze</span>
        <input
          v-model="stanze"
          class="filtri"
          type="number"
          @input="filtering()"
        />
      </div>
      <div
        class="col-lg-3 col-md-6"
        v-for="apartment in store.filteredApartments"
        :key="apartment.id"
      >
        <router-link
          class="card my-3"
          :to="`/apartments/${apartment.id}/${apartment.title}`"
        >
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
  </div>
</template>

<script>
import axios from "axios";
import { store } from "../store";
export default {
  name: "AdvancedSearch",

  data() {
    return {
      store,
      letti: "",
      stanze: "",
      perPage: 8,
      currentPage: 1,
      // serviziSelezionati: [],
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

    // LOGICA FILTRO IN BACK END
    filtering() {
      if (this.letti <= 0) {
        this.letti = 1;
      }
      if (this.stanze <= 0) {
        this.stanze = 1;
      }
      const selectedServiceIds = store.services
        .filter((servizio) => servizio.selected)
        .map((servizio) => servizio.id);
      console.log(selectedServiceIds);

      axios
        .get("http://127.0.0.1:8000/api/apartmentApi/filter", {
          params: {
            letti: this.letti,
            stanze: this.stanze,
            servizi: selectedServiceIds,
            // zona
            // servizi
          },
        })
        .then((res) => {
          store.filteredApartments = res.data;
          // Gestisci la risposta qui
          console.log(res.data);
        })
        .catch((error) => {
          console.error(
            "Errore durante il filtraggio degli appartamenti:",
            error
          );
        });
    },
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/api/apartmentApi/services")
      .then((res) => {
        store.services = res.data;
        console.log("servizi:", store.services);
      })
      .catch((err) => {
        console.log(err);
      });
    // ottieni elenco servizi
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
