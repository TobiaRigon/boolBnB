<template>
  <swiper
    :modules="modules"
    :slides-per-view="1"
    :space-between="20"
    :autoplay="true"
    :autoplay-speed="5000"
    navigation
    :pagination="{ clickable: true }"
    :scrollbar="{ draggable: true }"
    @swiper="onSwiper"
    @slideChange="onSlideChange"
    
  >
    <swiper-slide>
      <img src="../assets/images/pexels-kelly-17311064.jpg" class="d-block w-100" alt="Slide 1">
    </swiper-slide>

    <swiper-slide>
      <img src="../assets/images/pexels-michael-giugliano-2940654.jpg" class="d-block w-100" alt="Slide 2">
    </swiper-slide>

    <swiper-slide>
      <img src="../assets/images/pexels-julie-aagaard-2097092.jpg" class="d-block w-100" alt="Slide 3">
    </swiper-slide>

    <swiper-slide>
      <img src="../assets/images/pexels-chait-goli-1796736.jpg" class="d-block w-100" alt="Slide 4">
    </swiper-slide>

   <swiper-slide>
      <img src="../assets/images/pexels-chait-goli-1796736.jpg" class="d-block w-100" alt="Slide 5">
    </swiper-slide>
  
    <swiper-slide>
      <img src="../assets/images/pexels-chait-goli-1796736.jpg" class="d-block w-100" alt="Slide 6">
    </swiper-slide>
    ...
  </swiper>
</template>

<script>

   // import Swiper core and required modules
   import { Navigation, Pagination, Scrollbar, A11y, Autoplay } from 'swiper/modules';

  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';

  // Import Swiper styles
  import 'swiper/css';
  import 'swiper/css/navigation';
  import 'swiper/css/pagination';
  import 'swiper/css/scrollbar';
  import 'swiper/css/autoplay';

  export default {
    components: {
      Swiper,
      SwiperSlide,
    },
    setup() {
      const onSwiper = (swiper) => {
        console.log(swiper);
      };
      const onSlideChange = () => {
        console.log('slide change');
      };
      return {
        onSwiper,
        onSlideChange,
        modules: [Navigation, Pagination, Scrollbar, A11y, Autoplay],
      };
    },
  };
</script>

<style scoped> 


</style>

    
  