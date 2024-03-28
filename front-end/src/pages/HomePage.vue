<script>
import axios from "axios";
import { store } from "../store";
import Searchbar from "../components/Searchbar.vue";
import Banner from "../components/Banner.vue";
import SponsoredApartments from "../components/SponsoredApartments.vue";
import AlloggiPreferiti from "../components/AlloggiPreferiti.vue";

export default {
  name: "HomePage",
  components: {
    Searchbar,
    Banner,
    SponsoredApartments,
    AlloggiPreferiti,
  },
  data() {
    return {
      store,
      // oggetti che vediamo nell'autocomplete
      AutoMenu: [],
      //  località scelta dal menu autocomplete
      research: [],
      // serve per chiudere autocomplete quando clicco su un risultato
      showAutoComplete: true,
      // Metodo della foto in Home
      // backgroundImages: [
      //   "../assets/images/pexels-matteo-milan-18786201.jpg",
      //   "../assets/images/pexels-pixabay-163864.jpg"
      // ],
      // currentBackgroundIndex: 0,
      // intervalId: null,
    };
  },
  methods: {
    // handleScroll() {
    //             // Gestisce lo scrolling della finestra
    //             if (window.scrollY > 100) { // Imposta un valore di soglia per lo scrolling
    //                 this.isScrolled = true; // Se si è scrollati oltre la soglia, imposta isScrolled a true
    //             } else {
    //                 this.isScrolled = false; // Altrimenti, imposta isScrolled a false
    //             }
    // },

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
    // definisco variabile url
    let searchUrl = "http://127.0.0.1:8000/api/apartmentApi/search?search=";
    axios
      .get(searchUrl)
      .then((res) => {
        store.apartments = res.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },
  // Funzione per stop Background
  // beforeDestroy() {
  //   this.stopBackgroundRotation();
  // }
};
</script>

<template>
  <main>
    <div class="container-fluid">
      <!-- Jumbo + ricerca -->

      <AlloggiPreferiti />
      <div
        class="jumbotron d-flex align-items-center justify-content-center"
        id="top"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="col">
                <h1>Cerca il tuo appartamento</h1>
              </div>
            </div>
          </div>
          <Searchbar
            :store="store"
            :autoComplete="autoComplete"
            :search="search"
            :selectItem="selectItem"
            :showAutoComplete="showAutoComplete"
            :AutoMenu="AutoMenu"
          />
        </div>
      </div>
      <!-- BANNER -->
      <Banner />
      <!-- Appartamenti in evidenza -->
      <SponsoredApartments />
    </div>
    <footer />
  </main>
</template>

<style scoped>
li {
  list-style: none;
}


#AutoComplete ul li:hover {
  background-color: rgba(0, 0, 255, 0.1);
  border: 1px solid darkgrey;
}

.container-fluid {
  position: relative;
}

.jumbotron {
  border-radius: 30px;
  height: 500px;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1; /* Assicura che il jumbotron sia sopra ogni altro contenuto */
}

h1 {
  color: white;
  font-size: 52px;
  font-weight: bold;
}
</style>
