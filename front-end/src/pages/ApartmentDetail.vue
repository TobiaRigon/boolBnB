<template>
    <main>
      <div class="container">
        <h1>Apartment Details</h1>
  
        <ApartmentDetailApi />
  
      </div>
    </main>
  </template>
  
  <script>
  import ApartmentDetailApi from '../components/ApartmentDetailApi.vue';
  
  export default {
    components: {
        ApartmentDetailApi,
    },
  };
  </script>