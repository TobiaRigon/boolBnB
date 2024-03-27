<template>
  <div class="container-fluid py-3">
    <nav class="px-2 navbar navbar-expand-lg">
      <ul class="navbar-nav">
        <li class="px-1 nav-item">
          <router-link class="nav-link" to="/">
            <img src="../../public/BoolBnB_Logo.svg" alt="Logo" id="logo" />
          </router-link>
        </li>
        <li class="px-1 nav-item">
          <router-link class="nav-link" to="/">Home</router-link>
        </li>
        <li class="px-1 nav-item">
          <router-link class="nav-link" to="/search">Appartamenti</router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link" :href="loginUrl">Login/Dashboard</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loginUrl: "http://localhost:8000/login", // Memorizzazione dell'URL di login in una variabile
      singinUrl: "http://localhost:8000/register", // Memorizzazione dell'URL di singin in una variabile
      apartmentsUrl: "http://localhost:8000/apartments",
    };
  },
};
</script>

<style scoped>
#logo {
  width: 60px;
  height: 50px;
}

/* Impostazioni globali per il testo */
.nav-link {
  font-family: "Poppins", sans-serif; /* Cambio del font principale */
  font-size: 16px; /* Imposta la dimensione del carattere predefinita */
  line-height: 1.5; /* Imposta l'altezza della riga predefinita */
  color: #1c3a4a; /* Cambio del colore del testo principale */
}

@media (min-width: 991.98px) {
  .navbar-nav {
    align-items: center; /* Allinea gli elementi al centro quando il viewport è inferiore a lg */
  }
}
</style>
