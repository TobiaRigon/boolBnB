<template>
  <main>
    <div class="container">
      <ApartmentDetailApi />
      <MessageFormApi />
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
