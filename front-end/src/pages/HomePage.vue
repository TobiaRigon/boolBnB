<script>
import axios from "axios";
import { store } from "../store";
export default {
  name: "HomePage",
  data() {
    return {
      store,
      // prende le informazioni dalla searchbar; è necessario per l'autocomplete
      // findApartment: "",
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
    makeSlug(title) {
      return title
        .toLowerCase() // Converti tutto in minuscolo
        .replace(/\s+/g, "-") // Sostituisci gli spazi con trattini
        .replace(/[^\w\-]+/g, "") // Rimuovi tutti i caratteri non alfanumerici eccetto i trattini
        .replace(/\-\-+/g, "-"); // Sostituisci multipli trattini con un singolo trattino
    },
    // metodo per autocomplete tomtom
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
    search() {
      // Esegui il filtraggio solo se l'area è stata selezionata
      if (store.findApartment) {
        this.filtering();
      }
    },
    filtering() {
      // Costruisci l'oggetto dei parametri includendo tutti i filtri e la posizione
      const params = {
        lat: store.lat,
        lon: store.lon,
        raggio: store.radius,
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
    },
    handleSearch(event) {
      event.preventDefault(); // Evita il ricaricamento della pagina
    },
    // seleziona item nell'elenco di ricerca degli indirizzi
    selectItem(item) {
      store.findApartment = item.address.freeformAddress;
      this.showAutoComplete = false;
      store.lat = item.position.lat;
      store.lon = item.position.lon;
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

    getInEvidenceApartments() {
      axios
        .get("http://127.0.0.1:8000/api/apartments/in-evidence")
        .then((response) => {
          this.apartmentsInEvidence = response.data; // Salva gli appartamenti in evidenza nell'array separato
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
    formattedPath(apartment) {
      const titleFormatted = apartment.title.toLowerCase().replace(/\s+/g, "-");
      return `/apartments/${apartment.id}/${titleFormatted}`;
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
  // chiamata api al database
  mounted() {
    let searchUrl = "http://127.0.0.1:8000/api/apartmentApi/search?search=";
    this.getInEvidenceApartments();

    axios
      .get(searchUrl)
      .then((res) => {
        store.apartments = res.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>

<template>
  <main>
    <div class="container-fluid">
      <!-- Jumbo + ricerca -->
      <div class="jumbotron d-flex align-items-center justify-content-center">
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
              v-model="store.findApartment"
              @input="autoComplete"
            />
            <router-link
              :to="'/search/'"
              @click="search()"
              class="btn my_btn my-sm-0"
              type="submit"
            >
              Trova
            </router-link>

            <!-- Inizio: Elemento per l'autocompletamento -->
            <div
              id="AutoComplete"
              style="margin-top: 40px"
              class="card position-absolute w-80 h-50 radius"
              v-show="
                showAutoComplete &&
                AutoMenu.length > 0 &&
                store.findApartment.trim() !== ''
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
      </div>

      <!-- Appartamenti in evidenza -->

      <div class="mt-4 container-fluid text-center">
        <h2 class="my-3 h2">Appartamenti in evidenza</h2>
        <div class="apartments-in-evidence">
          <div class="row">
            <div
              class="col-lg-3 col-md-6"
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
    </div>
  </main>
</template>

<style scoped>
.form-control {
  max-width: 100%; /* Larghezza massima al 100% */
  width: 100%; /* Larghezza al 100% */
  min-width: 200px; /* Larghezza minima */
}

a {
  text-decoration: none;
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

.my_btn {
  background-color: #63beec;
  color: white;
  font-weight: bold;
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

.jumbotron {
  border-radius: 30px;
  background-image: url("../assets/images/pexels-matteo-milan-18786201.jpg");
  background-size: cover;
  background-position: center;
  height: 500px;
}

h1 {
  color: white;
  font-size: 52px;
  font-weight: bold;
}
</style>
