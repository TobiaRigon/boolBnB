<script>
export default {
  name: "ApartmentComponent",
  props: ["store", "formattedPath", "getImageUrl"],
};
</script>

<template>
  <div class="container">
    <div class="row">
      <div>
        <h5>Appartamenti Trovati: {{ store.filteredApartments.length }}</h5>
      </div>
      <div
        class="col-lg-3 col-md-6"
        v-for="apartment in store.filteredApartments"
        :key="apartment.id"
      >
        <router-link
          class="card my-3"
          :class="{ 'sponsored-apartment': apartment.in_evidence }"
          :to="formattedPath(apartment)"
        >
          <div class="card-container">
            <img
              :src="getImageUrl(apartment.main_img)"
              class="card-img-top"
              alt="..."
            />
            <div class="card-body">
              <h5 class="card-title">{{ apartment.title }}</h5>
              <p class="card-text">{{ apartment.description }}</p>
              <p class="card-text">
                <small
                  ><i class="fa-solid fa-person-walking-arrow-right"></i>
                  {{ apartment.distance }} km</small
                >
              </p>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<style scoped>
.card {
  height: 500px;
  overflow: hidden;
}
.card-container {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}

.card-text {
  overflow-y: auto;
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
.card-text::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}
img {
  height: 180px;
  width: 100%;
  object-fit: cover;
}
img:hover {
  transform: scale(1.1);
  transition: 1.7s;
}
a {
  text-decoration: none;
}
.card-text::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}
</style>
