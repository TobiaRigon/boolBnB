<template>
  <div class="container">
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
    <!-- <div class="btn-container">
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
    </div> -->
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
    changeRadius() {
      this.setRadius();
      this.isInNewArea();
      console.log("porcodeddioooooooooo");
      console.log("appartamenti del db:", store.apartments);
    },
    setRadius() {
      // Converti le coordinate da stringhe a numeri
      const lat = parseFloat(store.lat);
      const lon = parseFloat(store.lon);

      // Converti il raggio da km a gradi (approssimativamente)
      const latDelta = store.radius / 110.574; // 1 grado di latitudine è circa 110.574 km
      const lonDelta =
        store.radius / (111.32 * Math.cos(lat * (Math.PI / 180))); // 1 grado di longitudine varia in base alla latitudine

      // Calcola le nuove coordinate
      const newLatPlus = lat + latDelta;
      const newLatMinus = lat - latDelta;
      const newLonPlus = lon + lonDelta;
      const newLonMinus = lon - lonDelta;

      store.maxLat = newLatPlus;
      store.minLat = newLatMinus;
      store.minLon = newLonMinus;
      store.maxLon = newLonPlus;

      console.log(`Nuove coordinate con raggio di ${store.radius} km:`);

      console.log("Latitudine massima :", store.maxLat);
      console.log("Latitudine minima:", store.minLat);
      console.log("Longitudine massima:", store.maxLon);
      console.log("Longitudine minima:", store.minLon);
    },
    isInNewArea() {
      // Array temporaneo per tracciare gli appartamenti nell'area delineata
      const apartmentsInArea = [];

      // Itera sugli appartamenti nel database
      for (let i = 0; i < store.apartments.length; i++) {
        const apartment = store.apartments[i];

        // Verifica se l'appartamento è nell'area delineata
        const isInCurrentArea =
          store.minLat <= apartment.latitude &&
          apartment.latitude <= store.maxLat &&
          store.minLon <= apartment.longitude &&
          apartment.longitude <= store.maxLon;

        // Verifica se l'appartamento è già presente in filteredApartments
        const isAlreadyFiltered = store.filteredApartments.some(
          (filteredApartment) => filteredApartment.id === apartment.id
        );

        if (isInCurrentArea && !isAlreadyFiltered) {
          // Se l'appartamento è nell'area ma non è presente in filteredApartments, lo aggiungi
          store.filteredApartments.push(apartment);
        } else if (!isInCurrentArea && isAlreadyFiltered) {
          // Se l'appartamento non è più nell'area ma è presente in filteredApartments, lo rimuovi
          const indexToRemove = store.filteredApartments.findIndex(
            (filteredApartment) => filteredApartment.id === apartment.id
          );
          store.filteredApartments.splice(indexToRemove, 1);
        }

        // Aggiungi l'appartamento corrente agli appartamenti nell'area per evitare di aggiungerlo più volte
        if (isInCurrentArea) {
          apartmentsInArea.push(apartment);
        }
      }

      // Verifica se ci sono appartamenti in filteredApartments che non sono più nell'area e li rimuove
      for (let j = store.filteredApartments.length - 1; j >= 0; j--) {
        const filteredApartment = store.filteredApartments[j];
        const isStillInArea = apartmentsInArea.some(
          (apartment) => apartment.id === filteredApartment.id
        );
        if (!isStillInArea) {
          store.filteredApartments.splice(j, 1);
        }
      }

      console.log(
        "Filtered apartments within the area:",
        store.filteredApartments
      );
      console.log("Appartamenti nel database:", store.apartments);
      console.log("Radius:", store.radius);
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
