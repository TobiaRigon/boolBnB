<script>
import axios from "axios";
import { store } from "../store";
export default {
  name: "HomePage",
  data() {
    return {
      // prende le informazioni dalla searchbar; è necessario per l'autocomplete
      findApartment: "",
      // oggetti che vediamo nell'autocomplete
      AutoMenu: [],
      //  località scelta dal menu autocomplete
      research: [],
      // serve per chiudere autocomplete quando clicco su un risultato
      showAutoComplete: true,
      apartmentsInEvidence: [],
    };
  },
  methods: {
    // Metodo per cambiare pagina
    changePage(num) {
      this.currentPage += num;
      console.log(this.currentPage);
    },
    // metodo per autocomplete tomtom
    autoComplete() {
      const keyApi = "brzK3He1s61mi6MQycw8qJXnuSAtFOfx";
      let tomTomApi = `https://api.tomtom.com/search/2/search/${this.findApartment}.json?key=${keyApi}`;
      console.log(tomTomApi);
      axios
        .get(tomTomApi)
        .then((res) => {
          this.AutoMenu = res.data.results;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    // voglio settare un raggio con queste info (lat e lon)
    searchItem() {
      store.lat = this.research.position.lat;
      console.log(store.lat);
      store.lon = this.research.position.lon;
      console.log(store.lon);
      this.via = this.research.address.freeformAddress;
      this.city = this.research.municipality;
      this.country = this.research.country;
      console.log(this.research);
      this.setRadius();
      this.isInArea();
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

      console.log("Nuove coordinate con raggio di 20 km:");

      console.log("Latitudine massima :", store.maxLat);
      console.log("Latitudine minima:", store.minLat);
      console.log("Longitudine massima:", store.maxLon);
      console.log("Longitudine minima:", store.minLon);
    },
    // metodo per cercare gli appartamenti nell'area selezionata
    isInArea() {
      for (let i = 0; i < store.apartments.length; i++) {
        const apartment = store.apartments[i];
        if (
          store.minLat <= apartment.latitude &&
          apartment.latitude <= store.maxLat &&
          store.minLon <= apartment.longitude &&
          apartment.longitude <= store.maxLon
        ) {
          // li mando nello store
          store.filteredApartments.push(apartment);
        }
      }
      console.log("questo è lo store:", store.filteredApartments);
    },

    handleSearch(event) {
      event.preventDefault(); // Evita il ricaricamento della pagina
    },
    // seleziona item nell'elenco di ricerca degli indirizzi
    selectItem(item) {
      this.findApartment = item.address.freeformAddress;
      this.research = item;
      this.showAutoComplete = false; // Chiudi il menu dell'autocompletamento dopo la selezione
      console.log("raggio aggiornato:", store.radius);
      console.log("research:", this.research);
      store.locationResearch.push(this.research);
      console.log("store location:", store.locationResearch);
    },
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
    getInEvidenceApartments() {
      axios
        .get("http://127.0.0.1:8000/api/apartments/in-evidence")
        .then((response) => {
          this.apartmentsInEvidence = response.data; // Salva gli appartamenti in evidenza nell'array separato
          console.log("Appartamenti in evidenza:", this.apartmentsInEvidence); // Aggiungi questo console.log
        })
        .catch((error) => {
          console.error("Error fetching in-evidence apartments:", error);
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
    getInEvidenceApartments() {
      axios
        .get("http://127.0.0.1:8000/api/apartments/in-evidence")
        .then((response) => {
          this.apartmentsInEvidence = response.data; // Salva gli appartamenti in evidenza nell'array separato
          console.log("Appartamenti in evidenza:", this.apartmentsInEvidence); // Aggiungi questo console.log
        })
        .catch((error) => {
          console.error("Error fetching in-evidence apartments:", error);
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
  },
  // chiamata api al database
  mounted() {
    // definisco variabile url
    let searchUrl = "http://127.0.0.1:8000/api/apartmentApi/search?search=";
    // se non è vuoto aggiungo quello che trovo nell'input
    console.log(searchUrl);

    this.getApartments();
    this.getInEvidenceApartments();

    axios
      .get(searchUrl)
      .then((res) => {
        store.apartments = res.data;
        console.log(store.apartments);
      })
      .catch((err) => {
        console.log(err);
      });
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
          @input="autoComplete"
        />
        <router-link
          :to="'/search/'"
          @click="searchItem()"
          class="btn btn-outline-success my-2 my-sm-0"
          type="submit"
        >
          Search
        </router-link>

        <!-- Inizio: Elemento per l'autocompletamento -->
        <div
          id="AutoComplete"
          style="margin-top: 40px"
          class="card position-absolute w-80 h-50 radius"
          v-show="
            showAutoComplete &&
            AutoMenu.length > 0 &&
            findApartment.trim() !== ''
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
        <!-- Fine: Elemento per l'autocompletamento -->
      </form>
    </div>

    <div>
      <h2>Appartamenti in evidenza</h2>
      <div class="apartments-in-evidence">
        <div class="row">
          <div
            class="col-lg-3 col-md-6"
            v-for="apartment in apartmentsInEvidence"
            :key="apartment.id"
          >
            <router-link
              class="card my-3"
              :to="`/apartments/${apartment.id}/${apartment.title}`"
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
</style>
