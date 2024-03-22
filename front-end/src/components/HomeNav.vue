<template>
  <div class="container-fluid pt-3">
    <nav class="px-2 navbar navbar-expand-lg">
      <ul class="navbar-nav">
        <li class="px-1 nav-item">
          <img src="../../public/BoolBnB_Logo.svg" alt="Logo" id="logo" />
        </li>
        <li class="px-1 nav-item">
          <router-link class="nav-link" to="/">Home</router-link>
        </li>
        <li class="px-1 nav-item">
          <router-link class="nav-link" to="/apartments"
            >Appartamenti</router-link
          >
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
  width: 40px;
  height: 40px;
}
</style>
