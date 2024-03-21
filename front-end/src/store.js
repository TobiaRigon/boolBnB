import { reactive } from "vue";
//
export const store = reactive({
  filteredApartments: [],
  locationResearch: [],
  // appartamenti database
  apartments: [],
  //  località scelta dal menu autocomplete
  research: [],
  // serve per chiudere autocomplete quando clicco su un risultato
  //  showAutoComplete: true,
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
