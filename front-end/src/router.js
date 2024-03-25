// IMPORTIAMO LE FUNZIONI NECESSARIE
import { createRouter, createWebHashHistory } from "vue-router";

// IMPORTIAMO PAGINE O COMPONENTI NECESSARI
import HomePage from "./pages/HomePage.vue";
import AdvancedSearch from "./pages/AdvancedSearch.vue";
import Apartments from "./pages/Apartments.vue";
import ApartmentDetail from "./pages/ApartmentDetail.vue";
import NewSearch from "./pages/NewSearch.vue";

// IMPORTIAMO IL COMPONENTE PER LA GESTIONE DEI MESSAGGI
import MessageFormApi from "./components/MessageFormApi.vue";

// DEFINIAMO L'ARRAY DI ROTTE
const routes = [
  { path: "/", component: HomePage },
  { path: "/search", component: AdvancedSearch },
  { path: "/apartments", component: Apartments },
  { path: "/apartments/:id/:title", component: ApartmentDetail },
  { path: "/message", component: MessageFormApi },
  { path: "/newsearch", component: NewSearch },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export { router };
