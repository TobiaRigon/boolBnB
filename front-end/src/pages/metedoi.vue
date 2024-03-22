<script>
// filtering() {
//   if (this.letti < 1) {
//     this.letti = 1;
//   }
//   if (this.letti > 30) {
//     this.letti = 30;
//   }
//   if (this.stanze < 1) {
//     this.stanze = 1;
//   }
//   if (this.stanze > 10) {
//     this.stanze = 10;
//   }
//   // Filtra gli appartamenti in base ai nuovi criteri di filtraggio
//   store.filteredApartments = store.appartamentiFiltrati.filter(
//     (apartment) => {
//       const lettoPass =
//         this.letti === "" || parseInt(this.letti) <= apartment.beds;
//       const stanzePass =
//         this.stanze === "" || parseInt(this.stanze) <= apartment.rooms;
//       return lettoPass && stanzePass;
//     }
//   );
//   console.log(store.filteredApartments);
// },
//     changeRadius() {
//       this.setRadius();
//       this.isInNewArea();
//       console.log("appartamenti del db:", store.apartments);
//     },
//     setRadius() {
//       // Converti le coordinate da stringhe a numeri
//       const lat = parseFloat(store.lat);
//       const lon = parseFloat(store.lon);

//       // Converti il raggio da km a gradi (approssimativamente)
//       const latDelta = store.radius / 110.574; // 1 grado di latitudine è circa 110.574 km
//       const lonDelta =
//         store.radius / (111.32 * Math.cos(lat * (Math.PI / 180))); // 1 grado di longitudine varia in base alla latitudine

//       // Calcola le nuove coordinate
//       const newLatPlus = lat + latDelta;
//       const newLatMinus = lat - latDelta;
//       const newLonPlus = lon + lonDelta;
//       const newLonMinus = lon - lonDelta;

//       store.maxLat = newLatPlus;
//       store.minLat = newLatMinus;
//       store.minLon = newLonMinus;
//       store.maxLon = newLonPlus;

//       console.log(`Nuove coordinate con raggio di ${store.radius} km:`);

//       console.log("Latitudine massima :", store.maxLat);
//       console.log("Latitudine minima:", store.minLat);
//       console.log("Longitudine massima:", store.maxLon);
//       console.log("Longitudine minima:", store.minLon);
//     },
//     isInNewArea() {
//       // Array temporaneo per tracciare gli appartamenti nell'area delineata
//       const apartmentsInArea = [];

//       // Itera sugli appartamenti nel database
//       for (let i = 0; i < store.apartments.length; i++) {
//         const apartment = store.apartments[i];

//         // Verifica se l'appartamento è nell'area delineata
//         const isInCurrentArea =
//           store.minLat <= apartment.latitude &&
//           apartment.latitude <= store.maxLat &&
//           store.minLon <= apartment.longitude &&
//           apartment.longitude <= store.maxLon;

//         // Verifica se l'appartamento soddisfa anche i filtri stanze e letti
//         const lettoPass =
//           this.letti === "" || parseInt(this.letti) <= apartment.beds;
//         const stanzePass =
//           this.stanze === "" || parseInt(this.stanze) <= apartment.rooms;

//         if (isInCurrentArea && lettoPass && stanzePass) {
//           apartmentsInArea.push(apartment);
//         }
//       }

//       // Aggiorna store.filteredApartments con gli appartamenti nell'area che soddisfano i filtri
//       store.filteredApartments = apartmentsInArea;

//       console.log(
//         "Filtered apartments within the area:",
//         store.filteredApartments
//       );
//       console.log("Appartamenti nel database:", store.apartments);
//       console.log("Radius:", store.radius);
//     },
</script>
