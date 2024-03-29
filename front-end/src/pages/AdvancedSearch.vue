<template>
  <main>
    <div
      class="container-fluid my_container d-flex flex-column align-items-center"
    >
      <Searchbar
        class="searchbar"
        :store="store"
        :autoComplete="autoComplete"
        :search="search"
        :selectItem="selectItem"
        :showAutoComplete="showAutoComplete"
        :AutoMenu="AutoMenu"
      />
      <div>
        <!-- Bottone per aprire l'off-canvas per i filtri -->
        <button
          class="my_btn btn my-3"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#filtersSidebar"
          aria-controls="filtersSidebar"
        >
          Filtri
        </button>
        <span class="active-filters-text mx-2 mt-3 mb-0">
          Filtri attivi: {{ activeFiltersCount }}
        </span>
      </div>
    </div>

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
        <div class="container mt-3">
          <div class="row">
            <div
              v-for="servizio in store.services"
              :key="servizio.id"
              class="ms-4 mb-1"
            >
              <input
                class="my_checkbox"
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
    <ApartmentComponent
      :store="store"
      :formattedPath="formattedPath"
      :getImageUrl="getImageUrl"
    />
  </main>
</template>

<script>
import axios from "axios";
import { store } from "../store";
import ApartmentComponent from "../components/ApartmentComponent.vue";
import Searchbar from "../components/Searchbar.vue";
export default {
  name: "search",
  components: {
    ApartmentComponent,
    Searchbar,
  },
  data() {
    return {
      store,
      findApartment: "",
      AutoMenu: [],
      research: [],
      appartamentiFiltrati: [],
      showAutoComplete: true,
      activeFiltersCount: 0,
    };
  },
  methods: {
    autoComplete() {
      this.showAutoComplete = true;
      const keyApi = "brzK3He1s61mi6MQycw8qJXnuSAtFOfx";
      let tomTomApi = `https://api.tomtom.com/search/2/search/${store.findApartment}.json?key=${keyApi}`;

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
      store.findApartment = item.address.freeformAddress;
      this.showAutoComplete = false;
      store.lat = item.position.lat;
      store.lon = item.position.lon;
    },

    search() {
      // Esegui il filtraggio solo se l'area è stata selezionata
      if (!store.findApartment.trim()) {
        this.getAllApartments();
        console.log(this.getAllApartments);
      } else {
        this.filtering();
      }
    },
    getAllApartments() {
      axios
        .get("http://127.0.0.1:8000/api/apartmentApi/apartments")
        .then((response) => {
          store.filteredApartments = response.data.sort(
            (a, b) => b.in_evidence - a.in_evidence
          );
        })
        .catch((error) => {
          console.error(
            "Errore durante il recupero degli appartamenti:",
            error
          );
        });

      // if (store.filteredApartments === 0) {
      //   axios
      //     .get("http://127.0.0.1:8000/api/apartmentApi/apartments")
      //     .then((response) => {
      //       store.filteredApartments = response.data.sort(
      //         (a, b) => b.in_evidence - a.in_evidence
      //       );
      //     })
      //     .catch((error) => {
      //       console.error(
      //         "Errore durante il recupero degli appartamenti:",
      //         error
      //       );
      //     });
      // }
    },
    formattedPath(apartment) {
      const titleFormatted = apartment.title.toLowerCase().replace(/\s+/g, "-");
      return `/apartments/${apartment.id}/${titleFormatted}`;
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
      store.findApartment = "";
      this.showAutoComplete = true;

      // Calcola il numero di filtri attivi
      this.activeFiltersCount = store.services.filter(
        (servizio) => servizio.selected
      ).length;

      // Aggiungi il conteggio dei filtri per stanze e letti
      if (this.letti) {
        this.activeFiltersCount++;
      }
      if (this.stanze) {
        this.activeFiltersCount++;
      }
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
    // Chiamiamo la funzione filtering() per applicare i filtri quando il componente viene montato
    this.filtering();

    axios
      .get("http://127.0.0.1:8000/api/apartmentApi/services")
      .then((res) => {
        store.services = res.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>

<style scoped>
.searchbar {
  max-width: 80%;
  min-width: 1290px;
}

.my_container {
  margin: 0 auto;
}

.apartments-in-evidence {
  width: 90%;
  margin: 0 auto; /* Imposta i margini automatici per centrare il div */
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
.filtri {
  width: 20%;
  margin-right: 20px;
}

.my_btn {
  background-color: #63beec;
  border-radius: 10px;
  color: white;
}

.my_btn:hover {
  background-color: #5cb2dd;
  border-radius: 10px;
  color: white;
}
.my_btn a {
  color: white;
}
.my_btn a:hover {
  color: white;
}
</style>
