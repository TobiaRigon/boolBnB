<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <router-link class="nav-link" to="/">Home</router-link>
      </li>

      <!-- <li>
        <router-link to="/search">Search</router-link>
      </li>
      <li>
        <router-link to="/apartments">Sponsored Apartments</router-link>
      </li> -->

      <li class="nav-item">
        <a class="nav-link" :href="apartmentsUrl">Apartments </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" :href="loginUrl">Login/Dashboard</a>
      </li>
      <!-- <li>
        <a :href="singinUrl">Singin</a>
      </li> -->
    </ul>
  </nav>
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
