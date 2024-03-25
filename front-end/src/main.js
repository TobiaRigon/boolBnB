import { createApp } from "vue";
import "./style.css";
import MainLayout from "./layouts/MainLayout.vue";
import "@fortawesome/fontawesome-free/css/all.css";
// src/main.js or src/main.ts
import "bootstrap/dist/css/bootstrap.min.css"; // Importa il file CSS di Bootstrap
import "bootstrap/dist/js/bootstrap.bundle.min.js"; // Importa il file JavaScript di Bootstrap

// import App from './App.vue'

import { router } from "./router";

const app = createApp(MainLayout);

app.use(router);
app.mount("#app");
