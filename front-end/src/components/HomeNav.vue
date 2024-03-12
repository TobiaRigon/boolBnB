<template>
  <h5>HomeNav Component</h5>
  <div>
    <ul>
      <li>
        <router-link to="/">Home</router-link>
      </li>
      <li>
        <router-link to="/search">Search</router-link>
      </li>
      <li>
        <router-link to="/apartments">Sponsored Apartments</router-link>
      </li>
      <li>
        <a :href="loginUrl">Login</a>
      </li>
      <li>
        <a :href="singinUrl">Singin</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loginUrl: "http://localhost:8000/login", // Memorizzazione dell'URL di login in una variabile
      singinUrl: "http://localhost:8000/register", // Memorizzazione dell'URL di singin in una variabile
    };
  },
};
</script>
