<template>
  <h1>I NOSTRI APPARTAMENTI:</h1>

  <div class="container">
    <div class="row">
      <div
        class="col-lg-3 col-md-6"
        v-for="apartment in paginatedList"
        :key="apartment.id"
      >
        <div class="card my-3">
          <div class="card-container">
            <img :src="apartment.main_img" class="card-img-top" alt="..." />

            <h5 class="card-title p-2">{{ apartment.title }}</h5>
            <p class="card-text p-2">{{ apartment.description }}</p>
            <div class="d-flex justify-content-between">
              <router-link
                :to="'/apartments/' + apartment.id"
                class="btn btn-primary m-2"
                >APRI</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="btn-container">
      <div class="btn-wrapper">
        <button
          class="btn"
          type="button"
          :disabled="currentPage === 1"
          @click="changePage(-1)"
        >
          << Prev
        </button>
        <button
          class="btn"
          type="button"
          :disabled="currentPage === 4"
          @click="changePage(1)"
        >
          Next >>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AppartmentApi",
  data() {
    return {
      apartments: [],
      perPage: 8,
      currentPage: 1,
    };
  },
  computed: {
    paginatedList() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.apartments.slice(start, end);
    },
  },
  created() {
    this.getApartments();
  },
  methods: {
    getApartments() {
      axios
        .get("http://127.0.0.1:8000/api/apartmentApi/apartments")
        .then((res) => {
          this.apartments = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },
    changePage(num) {
      this.currentPage += num;
      console.log(this.currentPage);
    },
  },
};
</script>

<style scoped>
img {
  height: 180px;
  width: 100%;
  object-fit: cover;
}

.card {
  height: 500px;
}

.card-container {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}
.card-text {
  overflow-y: auto;
  height: 50%;
}
.btn-container {
  text-align: center;
}
.btn-wrapper {
  display: inline-block;
  margin: 0 auto;
}

.card-text::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}
.card-text {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
</style>
