<template>
  <main>
    <div class="container">
      <form class="form-inline my-2 gap-2 d-flex">
        <!-- Barra di ricerca -->
        <input
          class="form-control mr-sm-2"
          type="search"
          placeholder="Cerca"
          aria-label="Search"
          v-model="findApartment"
          @input="autoComplete"
        />
        <button
          @click.prevent="search()"
          class="btn btn-outline-success my-2 my-sm-0"
          type="button"
        >
          Cerca
        </button>
      </form>

      <!-- Autocompletamento -->
      <div
        id="AutoComplete"
        style="margin-top: 40px"
        class="card position-absolute w-80 h-50 radius"
        v-show="
          showAutoComplete && AutoMenu.length > 0 && findApartment.trim() !== ''
        "
      >
        <ul class="list" style="cursor: pointer">
          <li
            v-for="(item, index) in AutoMenu"
            :key="index"
            @click="selectItem(item)"
          >
            {{ item.address.freeformAddress }}
          </li>
        </ul>
      </div>
    </div>

    <!-- Bottone per aprire l'off-canvas per i filtri -->
    <button
      class="btn btn-primary"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#filtersSidebar"
      aria-controls="filtersSidebar"
    >
      Filtri
    </button>

    <!-- Off-canvas per i filtri -->
    <div id="filtersSidebar" class="offcanvas offcanvas-start" tabindex="-1">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filtri</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <!-- Inserisci qui i tuoi filtri -->
        <!-- Assicurati che i filtri siano separati dalla sezione dei risultati degli appartamenti -->
        <!-- ... -->
        <!-- Esempio di filtri -->
        <div class="container mt-3">
          <div class="row">
            <div
              v-for="servizio in store.services"
              :key="servizio.id"
              class="ms-4 mb-1"
            >
              <input
                type="checkbox"
                v-model="servizio.selected"
                @change="filtering(servizio.id)"
              />
              <label class="ms-2">{{ servizio.name }}</label>
            </div>
          </div>
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
                @input="filtering()"
              />
              <span class="input-group-text kilometri"
                >{{ store.radius }} km</span
              >
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
          </div>
        </div>
      </div>
    </div>

    <!-- Sezione per i risultati degli appartamenti -->
    <div class="container">
      <div class="row">
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
              <p class="card-text p-2">Distanza: {{ apartment.distance }} km</p>
              <!-- Inserisci la distanza qui -->
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
  </main>
</template>

<script>
import axios from "axios";
import { store } from "../store";

export default {
  name: "NewSearch",
  data() {
    return {
      store,
      letti: "",
      stanze: "",
      findApartment: "",
      AutoMenu: [],
      research: [],
      appartamentiFiltrati: [],
      showAutoComplete: true,
    };
  },
  methods: {
    autoComplete() {
      const keyApi = "brzK3He1s61mi6MQycw8qJXnuSAtFOfx";
      let tomTomApi = `https://api.tomtom.com/search/2/search/${this.findApartment}.json?key=${keyApi}`;

      axios
        .get(tomTomApi)
        .then((res) => {
          this.AutoMenu = res.data.results;
        })
        .catch((err) => {
          console.log(err);
        });
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

    selectItem(item) {
      this.findApartment = item.address.freeformAddress;
      this.showAutoComplete = false;
      store.lat = item.position.lat;
      store.lon = item.position.lon;
    },

    search() {
      // Esegui il filtraggio solo se l'area è stata selezionata
      if (this.findApartment) {
        this.filtering();
      } else {
        console.log("Seleziona un'area prima di effettuare la ricerca");
      }
    },
    filtering() {
      if (this.letti <= 0) {
        this.letti = 1;
      }
      if (this.stanze <= 0) {
        this.stanze = 1;
      }

      // Ottieni i filtri selezionati
      const selectedServiceIds = store.services
        .filter((servizio) => servizio.selected)
        .map((servizio) => servizio.id);

      // Costruisci l'oggetto dei parametri includendo tutti i filtri e la posizione
      const params = {
        letti: this.letti,
        stanze: this.stanze,
        servizi: selectedServiceIds,
        lat: store.lat, // Latitudine
        lon: store.lon, // Longitudine
        raggio: store.radius, // Raggio
        // Aggiungi qui eventuali altri filtri
      };

      // Effettua la chiamata API includendo tutti i filtri
      axios
        .get("http://127.0.0.1:8000/api/apartmentApi/filter", {
          params: params,
        })
        .then((res) => {
          // Calcola la distanza per ciascun appartamento nella risposta
          res.data.forEach((apartment) => {
            const distance = this.calculateDistance(
              apartment.latitude,
              apartment.longitude,
              store.lat,
              store.lon
            );
            apartment.distance = distance;
          });

          store.filteredApartments = res.data;
          // Gestisci la risposta qui
          console.log("filtrati", res.data);
        })
        .catch((error) => {
          console.error(
            "Errore durante il filtraggio degli appartamenti:",
            error
          );
        });
      this.findApartment = "";
      this.showAutoComplete = true;
    },
    calculateDistance(lat1, lon1, lat2, lon2) {
      const R = 6371; // Radius of the earth in km

      const dLat = this.deg2rad(lat2 - lat1);
      const dLon = this.deg2rad(lon2 - lon1);

      const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(this.deg2rad(lat1)) *
          Math.cos(this.deg2rad(lat2)) *
          Math.sin(dLon / 2) *
          Math.sin(dLon / 2);

      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

      const distance = Math.ceil(R * c); // Round up to the nearest integer

      return distance;
    },

    deg2rad(deg) {
      return deg * (Math.PI / 180);
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

.apartments-in-evidence {
  width: 90%;
  margin: 0 auto; /* Imposta i margini automatici per centrare il div */
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

li {
  list-style: none;
}
#AutoComplete {
  width: 50%;
  z-index: 999;
}

#AutoComplete ul li:hover {
  background-color: rgba(0, 0, 255, 0.1);
  border: 1px solid darkgrey;
}
.raggio {
  width: 30%;
}

/* .kilometri {
  width: 70px;
} */

.card-text::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}
</style>
