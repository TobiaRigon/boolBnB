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
        <router-link class="nav-link" to="/apartments"
          >Appartamenti</router-link
        >
      </li>


      <li class="nav-item" v-if="!isAuthenticated">
        <a class="nav-link" @click="handleLogin">Login</a>
      </li>
      <li class="nav-item" v-if="isAuthenticated">
        <router-link class="nav-link" to="/dashboard">Dashboard</router-link>
      </li>


      <li class="nav-item"  v-if="!isAuthenticated">
        <a class="nav-link" :href="singUpUrl">Singin</a>
      </li>
    </ul>
  </nav>
</template>

<script>
import { isAuthenticated, login } from '../auth'; // Importa le funzioni isAuthenticated e login dal modulo auth

export default {

  computed: {
    isAuthenticated() {
      return isAuthenticated();
    }
  },

  methods: {
    handleLogin() {
      login();
    }
  },


  data() {
    return {
      loginUrl: "http://localhost:8000/login", // Memorizzazione dell'URL di login in una variabile
      singinUrl: "http://localhost:8000/register", // Memorizzazione dell'URL di singin in una variabile
      apartmentsUrl: "http://localhost:8000/apartments",
    };
    
  },

  
};
</script>
