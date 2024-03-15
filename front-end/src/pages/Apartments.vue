<template>
  <main>
    <div class="container">
      <h1>Apartments</h1>

      <AppartmentApi />

    </div>
  </main>
</template>

<script>
import AppartmentApi from '../components/AppartmentApi.vue';

export default {
  components: {
    AppartmentApi,
  },
};
</script>