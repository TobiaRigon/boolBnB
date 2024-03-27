<template>
  <swiper
    class="swiper-slide"
    :modules="modules"
    :slides-per-view="1"
    :space-between="20"
    :autoplay="{
      delay: 5000,
      disableOnInteraction: false,
    }"
    :loop="true"
    :speed="1000"
    :effect="'slide'"
    @swiper="onSwiper"
    @slideChange="onSlideChange"
  >
    <swiper-slide class="swiper-slide">
      <div class="swiper-slide">
        <img
          src="../assets/images/pexels-kelly-17311064.jpg"
          class="d-block w-100 slide-image"
          alt="Slide 1"
        />
      </div>
    </swiper-slide>

    <swiper-slide class="swiper-slide">
      <div class="swiper-slide">
        <img
          src="../assets/images/pexels-michael-giugliano-2940654.jpg"
          class="d-block w-100 slide-image"
          alt="Slide 2"
        />
      </div>
    </swiper-slide>

    <swiper-slide class="swiper-slide">
      <div class="swiper-slide">
        <img
          src="../assets/images/pexels-julie-aagaard-2097092.jpg"
          class="d-block w-100 slide-image"
          alt="Slide 3"
        />
      </div>
    </swiper-slide>

    <swiper-slide class="swiper-slide">
      <div class="swiper-slide">
        <img
          src="../assets/images/pexels-chait-goli-1796736.jpg"
          class="d-block w-100 slide-image"
          alt="Slide 4"
        />
      </div>
    </swiper-slide>

    <swiper-slide class="swiper-slide">
      <div class="swiper-slide">
        <img
          src="../assets/images/pexels-matteo-milan-18786201.jpg"
          class="d-block w-100 slide-image"
          alt="Slide 4"
        />
      </div>
    </swiper-slide>

    ...
  </swiper>
</template>

<script>
// import Swiper core and required modules
import { Scrollbar, A11y, Autoplay } from "swiper/modules";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";
import "swiper/css/autoplay";

export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    const onSwiper = (swiper) => {};
    const onSlideChange = () => {};

    return {
      onSwiper,
      onSlideChange,
      modules: [A11y, Autoplay],
    };
  },
};
</script>

<style scoped>
.slide-image {
  height: 500px; /* Imposta l'altezza desiderata */
}

.swiper-slide {
  border-radius: 30px;
  overflow: hidden;
}
</style>
