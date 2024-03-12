<template>
  <h5>HomeNav Component</h5>
  <div>
    <ul>
      <li>
        <router-link to="/">Home</router-link>
      </li>
      <li>
        <router-link to="/apartments">Appartamenti</router-link>
      </li>
      <!-- se unloggato -->
      <li>
        <a :href="loginUrl">Login</a>
      </li>
      <!-- else -->
      <li>
        <a :href="dashboardUrl">Dashboard</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loginUrl: "http://localhost:8000/login", // Memorizzazione dell'URL di login in una variabile
      dashboardUrl: "http://localhost:8000/dashboard", // Memorizzazione dell'URL di login in una variabile
    };
  },
};
</script>
