import { reactive } from "vue";
//
export const store = reactive({
  filteredApartments: [],
  appartamentiFiltrati: [],
  removed: [],
  locationResearch: [],
  // appartamenti database
  apartments: [],
  //  località scelta dal menu autocomplete
  research: [],
  // serve per chiudere autocomplete quando clicco su un risultato
  //  showAutoComplete: true,
  // tutti i servizi chiamatai con axios per popolare dom
  services: [],
  // informazioni indirizzo scelto
  lat: "",
  lon: "",
  città: "",
  via: "",
  country: "",
  //
  // raggio di 20 km (valore base)
  radius: "20",
  // valori di lat settati sul raggio scelto
  maxLat: "",
  maxLon: "",
  minLat: "",
  minLon: "",
});
//
// http://127.0.0.1:8000/api/apartmentApi/filter?letti=2&stanze=2&lat=41.9028&lon=12.4964&raggio=10
// http://127.0.0.1:8000/api/apartmentApi/filter?lat=41.9028&lon=12.4964&radius=10
