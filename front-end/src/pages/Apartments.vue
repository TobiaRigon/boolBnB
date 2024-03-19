<template>
  <main>
    <div class="container">
      

      <a class="btn btn-success my-3" href="http://localhost:8000/create"
        >NUOVO APPARTAMENTO</a
      >
      <AppartmentApi />
    </div>
  </main>
</template>

<script>
import AppartmentApi from "../components/AppartmentApi.vue";

export default {
  components: {
    AppartmentApi,
  },
};
</script>
