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
    // Verifica se filteredApartments è vuoto prima di procedere
    if (store.appartamentiFiltrati.length > 0) {
        // Se non è vuoto, svuotalo prima di eseguire la nuova ricerca
        store.filteredApartments = [];
        store.appartamentiFiltrati = [];
    }

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

    // Calcolo della distanza per ogni appartamento nella zona
    for (let i = 0; i < store.filteredApartments.length; i++) {
        const apartment = store.filteredApartments[i];
        const distance = this.calculateDistance(apartment.latitude, apartment.longitude, store.lat, store.lon);
        apartment.distance = distance;
    }
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
          store.appartamentiFiltrati.push(apartment);
        }
      }
      console.log("questo è lo store:", store.filteredApartments);
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

    // Verifica se l'appartamento soddisfa anche i filtri stanze e letti
    const lettoPass =
      this.letti === "" || parseInt(this.letti) <= apartment.beds;
    const stanzePass =
      this.stanze === "" || parseInt(this.stanze) <= apartment.rooms;

    if (isInCurrentArea && lettoPass && stanzePass) {
      // Calcola la distanza tra l'appartamento e il punto di ricerca
      const distance = this.calculateDistance(apartment.latitude, apartment.longitude, store.lat, store.lon);
      // Aggiungi la distanza come proprietà dell'appartamento
      apartment.distance = distance;
      apartmentsInArea.push(apartment);
    }
    }

    // Aggiorna store.filteredApartments con gli appartamenti nell'area che soddisfano i filtri
    store.filteredApartments = apartmentsInArea;

    console.log(
    "Filtered apartments within the area:",
    store.filteredApartments
    );
    console.log("Appartamenti nel database:", store.apartments);
    console.log("Radius:", store.radius);
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
    // getApartments() {
    // definisco variabile url
    //   let searchUrl = `${this.searchApi}${this.findApartment}`;
    //   // se non è vuoto aggiungo quello che trovo nell'input
    //   console.log(searchUrl);

    //   axios
    //     .get(searchUrl)
    //     .then((res) => {
    //       this.apartments = res.data;
    //       console.log(this.apartments);
    //     })
    //     .catch((err) => {
    //       console.log(err);
    //     });
    // },
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

        
    calculateDistance(lat1, lon1, lat2, lon2) {
      const R = 6371; // Radius of the earth in km

      const dLat = this.deg2rad(lat2 - lat1);
      const dLon = this.deg2rad(lon2 - lon1);

      const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) *
          Math.sin(dLon / 2) * Math.sin(dLon / 2);

      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

      const distance = Math.ceil(R * c); // Round up to the nearest integer

      return distance;
    },


    deg2rad(deg) {
      return deg * (Math.PI / 180);
    },


    // Metodo per far rotare le foto in HOME
    // startBackgroundRotation() {
    //   this.intervalId = setInterval(this.changeBackground, 5000); //Cambia immagine ogni 5 secondi
    // },
    // stopBackgroundRotation() {
    //   clearInterval(this.intervalId);
    // },
    // changeBackground() {
    //   this.currentBackgroundIndex = (this.currentBackgroundIndex + 1) % this.backgroundImages.length;
    //   const imageUrl = this.backgroundImages[this.currentBackgroundIndex];
    //   document.querySelector('.jumbotron').style.backgroundImage = `url(${imageUrl})`;
    // },
  },
  // chiamata api al database
  mounted() {
    // definisco variabile url
    let searchUrl = "http://127.0.0.1:8000/api/apartmentApi/search?search=";
    // se non è vuoto aggiungo quello che trovo nell'input
    // Funzione per far partire la rotazione
    // this.startBackgroundRotation();
    // this.getApartments();
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
  // Funzione per stop Background
  // beforeDestroy() {
  //   this.stopBackgroundRotation();
  // }
};
</script>

<template>
  <main>
    <div class="jumbotron d-flex align-items-center justify-content-center">
      <div class="container" id="sezione-ricerca">
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
    </div>

    <div class="mt-4">
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

.jumbotron {
  background-image: url("../assets/images/pexels-matteo-milan-18786201.jpg");
  background-size: cover;
  background-position: center;
  height: 500px;
}

#sezione-ricerca {
  background-color: rgb(250, 235, 215, 0.5);
  padding: 20px;
  border-radius: 20px;
  transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s; /* Aggiungi una transizione per un effetto più fluido */
}

#sezione-ricerca:hover {
  background-color: rgba(
    250,
    235,
    215,
    0.7
  ); /* Cambia leggermente il colore di sfondo */
  transform: scale(1.02); /* Applica una leggera trasformazione di scala */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Aggiungi un'ombra sottile */
}
/* .kilometri {
  width: 70px;
} */
</style>
