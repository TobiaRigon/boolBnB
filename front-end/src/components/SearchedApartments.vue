<template>
  <!-- <div class="container">
    <div class="row">
      <div
        class="col-lg-3 col-md-6"
        v-for="apartment in paginatedList"
        :key="apartment.id"
      >
        <div class="card my-3">
          <div class="card-container">
            <img
              :src="getImageUrl(apartment.main_img)"
              class="card-img-top"
              alt="..."
            />

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
  </div> -->
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
</template>

<script></script>
