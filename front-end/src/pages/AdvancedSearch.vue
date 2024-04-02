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
        <!-- Pulsante per aprire l'off-canvas per i filtri -->
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
        <span class="active-filters-text mx-2 mt-3 mb-0">
          <span
            class="me-2"
            v-for="(icon, index) in selectedServiceIcons"
            :key="index"
          >
            <i :class="icon"></i>
          </span>
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
        <!-- Pulsante per visualizzare i servizi -->
        <button class="my_btn btn my-3" @click="showServices">Servizi</button>

        <!-- Contenitore per i servizi -->
        <div v-if="showServicesContent">
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
        </div>

        <!-- Altri filtri come il range e input per letti e stanze -->
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
      showServicesContent: false, // Per controllare la visibilità dei servizi
      selectedServiceIcons: [],
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
      if (imagePath.startsWith("storage")) {
        const baseUrl = "http://127.0.0.1:8000";
        return `${baseUrl}/${imagePath}`;
      } else {
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

      const selectedServiceIds = store.services
        .filter((servizio) => servizio.selected)
        .map((servizio) => servizio.id);

      const selectedServices = store.services.filter(
        (servizio) => servizio.selected
      );
      const serviceIcons = selectedServices.map(
        (servizio) => `fas ${servizio.icon}`
      );
      this.selectedServiceIcons = serviceIcons;
      console.log(this.selectedServiceIcons);

      const params = {
        letti: this.letti,
        stanze: this.stanze,
        servizi: selectedServiceIds,
        lat: store.lat,
        lon: store.lon,
        raggio: store.radius,
      };

      axios
        .get("http://127.0.0.1:8000/api/apartmentApi/filter", {
          params: params,
        })
        .then((res) => {
          store.filteredApartments = res.data;
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

      this.activeFiltersCount = store.services.filter(
        (servizio) => servizio.selected
      ).length;

      if (this.letti) {
        this.activeFiltersCount++;
      }
      if (this.stanze) {
        this.activeFiltersCount++;
      }
    },
    calculateDistance(lat1, lon1, lat2, lon2) {
      const R = 6371;

      const dLat = this.deg2rad(lat2 - lat1);
      const dLon = this.deg2rad(lon2 - lon1);

      const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(this.deg2rad(lat1)) *
          Math.cos(this.deg2rad(lat2)) *
          Math.sin(dLon / 2) *
          Math.sin(dLon / 2);

      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

      const distance = R * c;

      console.log("Distanza calcolata:", distance);

      return distance;
    },
    // Metodo per mostrare/nascondere i servizi
    showServices() {
      this.showServicesContent = !this.showServicesContent;
    },
  },
  mounted() {
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
  margin: 0 auto;
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
