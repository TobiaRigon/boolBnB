<script>
import axios from "axios";
import { store } from "../store";
export default {
  name: "HomePage",
  data() {
    return {
      findApartment: "",
      AutoMenu: [],
      apartments: [],
      // filteredApartments: [],
      research: [],
      perPage: 8,
      currentPage: 1,
      lat: "",
      lon: "",
      città: "",
      via: "",
      country: "",
      // raggio di 20 km
      radius: "20",
      maxLat: "",
      maxLon: "",
      minLat: "",
      minLon: "",
    };
  },
  methods: {
    // Metodo per cambiare pagina
    changePage(num) {
      this.currentPage += num;
      console.log(this.currentPage);
    },
    autoComplete() {
      const keyApi = "brzK3He1s61mi6MQycw8qJXnuSAtFOfx";
      let tomTomApi = `https://api.tomtom.com/search/2/search/${this.findApartment}.json?key=${keyApi}`;
      console.log(tomTomApi);
      axios
        .get(tomTomApi)
        .then((res) => {
          this.AutoMenu = res.data.results;
          console.log(this.AutoMenu);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    // voglio settare un raggio con queste info (lat e lon)
    selectItem(item) {
      this.findApartment = item.address.freeformAddress;
      this.research = item;
      console.log(this.research);
    },
    searchItem() {
      this.lat = this.research.position.lat;
      console.log(this.lat);
      this.lon = this.research.position.lon;
      console.log(this.lon);
      this.via = this.research.address.freeformAddress;
      this.city = this.research.municipality;
      this.country = this.research.country;
      console.log(this.research);
      this.setRadius();
      this.isInArea();
    },
    setRadius() {
      // Converti le coordinate da stringhe a numeri
      const lat = parseFloat(this.lat);
      const lon = parseFloat(this.lon);

      // Converti il raggio da km a gradi (approssimativamente)
      const latDelta = this.radius / 110.574; // 1 grado di latitudine è circa 110.574 km
      const lonDelta = this.radius / (111.32 * Math.cos(lat * (Math.PI / 180))); // 1 grado di longitudine varia in base alla latitudine

      // Calcola le nuove coordinate
      const newLatPlus = lat + latDelta;
      const newLatMinus = lat - latDelta;
      const newLonPlus = lon + lonDelta;
      const newLonMinus = lon - lonDelta;

      this.maxLat = newLatPlus;
      this.minLat = newLatMinus;
      this.minLon = newLonMinus;
      this.maxLon = newLonPlus;

      console.log("Nuove coordinate con raggio di 20 km:");
      console.log("Latitudine massima:", newLatPlus);
      console.log("Latitudine minima:", newLatMinus);
      console.log("Longitudine massima:", newLonPlus);
      console.log("Longitudine minima:", newLonMinus);
    },
    isInArea() {
      for (let i = 0; i < this.apartments.length; i++) {
        const apartment = this.apartments[i];
        if (
          this.minLat <= apartment.latitude &&
          apartment.latitude <= this.maxLat &&
          this.minLon <= apartment.longitude &&
          apartment.longitude <= this.maxLon
        ) {
          store.filteredApartments.push(apartment);
        }
      }
      console.log("questo è lo store:", store.filteredApartments);
    },

    handleSearch(event) {
      event.preventDefault(); // Evita il ricaricamento della pagina
    },
  },
  mounted() {
    // definisco variabile url
    let searchUrl = "http://127.0.0.1:8000/api/apartmentApi/search?search=";
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

  computed: {
    paginatedList() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.apartments.slice(start, end);
    },
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
        <!-- <button
          class="btn btn-outline-success my-2 my-sm-0"
          @click="searchItem()"
          type="submit"
        >
          Cerca
        </button> -->
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
          v-show="AutoMenu.length > 0 && findApartment.trim() !== ''"
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
}
#AutoComplete ul li:hover {
  background-color: rgba(0, 0, 255, 0.1);
  border: 1px solid darkgrey;
}
</style>
