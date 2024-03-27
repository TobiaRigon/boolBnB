<template>
  <main class="w-100">
    <h1 class="h1 text-center my-3">DETTAGLI APPARTAMENTO:</h1>
    <div class="container-fluid w-100">
      <div class="container-fluid row pt-3 w-100 d-flex justify-content-center">
        <div class="p-3 col-12 col-lg-6">
          <ApartmentDetailApi />
        </div>
        <div class="my_container p-3 col-12 col-lg-5">
          <MessageFormApi />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import ApartmentDetailApi from "../components/ApartmentDetailApi.vue";
import MessageFormApi from "../components/MessageFormApi.vue";

export default {
  components: {
    ApartmentDetailApi,
    MessageFormApi,
  },
};
</script>

<style scoped>
.card {
  overflow: hidden;
}
.container-fluid {
  margin: 0 auto;
}

.my_container {
  margin: 0 auto;
}
</style>
