<template>
  <footer class="footer mt-4">
    <div class="container ">
      
      <div class="row">

          <div class="col-md-4">
            <img src="../../public/BoolBnB_Logo.svg" alt="Logo" id="logo" />
            <br><br>
            <ul class="list-unstyled">

              <li>
                Abbiamo affrontato insieme un viaggio straordinario attraverso il vasto mondo della programmazione! Con umiltà e determinazione, ci siamo impegnati nel nostro progetto finale del corso Boolean. È stato un percorso di apprendimento intenso e gratificante, dove abbiamo superato sfide e celebrato successi. Siamo orgogliosi del lavoro svolto e grati per l'opportunità di crescere insieme! 🚀🌟
              </li>
            
            </ul>
        </div>

        
        <!-- <div class="col-md-3 offset-md-2 mt-5">
          <h5>Profili Linkedin</h5>
          <ul class="list-unstyled">
            <li><a href="https://www.linkedin.com/in/domenico-forlano-4796bb1b4/">Domenico Forlano</a></li>
            <li><a href="https://www.linkedin.com/in/tobia-rigon-ba0b051a2/">Tobia Rigon</a></li>
            <li><a href="https://www.linkedin.com/in/giacomo-agave-01090b257/">Giacomo Agave</a></li>
            <li><a href="https://www.linkedin.com/in/gabriele-di-rocco-6858972b8/">Gabriele Di Rocco</a></li>
            <li><a href="https://www.linkedin.com/in/filippo-cafaro-045aa0290/">Filippo Cafaro</a></li>
          </ul>
        </div>
        <div class="col-md-3 mt-5">
          <h5>Profili GitHub</h5>
          <ul class="list-unstyled">
            <li><a href="#"><i class="fa-brands fa-github"></i> Domenico Forlano</a></li>
            <li><a href="#"><i class="fa-brands fa-github"></i> Tobia Rigon</a></li>
            <li><a href="#"><i class="fa-brands fa-github"></i> Giacomo Agave</a></li>
            <li><a href="#"><i class="fa-brands fa-github"></i> Gabriele Di Rocco</a></li>
            <li><a href="#"><i class="fa-brands fa-github"></i> Filippo Cafaro</a></li>
          </ul>
        </div> -->
        <!-- <div class="col-md-3 offset-md-2 mt-5">

          <div id="carousel">
            <div class="swiper-slide">
              <img src="" alt="Nome Membro 1">
              <h3>Domenico Forlano</h3>
              <p>Descrizione Membro 1</p>
            </div>

            <div class="swiper-slide">
              <img src="" alt="Nome Membro 2">
              <h3>Tobia Rigon</h3>
              <p>Descrizione Membro 2</p>
            </div>
  
        
          </div>
        </div> -->

        <div class="col-md-5 offset-md-3 mt-5">
          
 <swiper
          :modules="modules"
          :slides-per-view="1"
          :space-between="20"
          :autoplay="true"
          :autoplay-speed="6000"
         
          @swiper="onSwiper"
          @slideChange="onSlideChange"
          
        >
        
        <swiper-slide>
          <div class="card my-card">
            <!-- Immagine del profilo -->
            <img src="../assets/images/FotoProfilo.jpeg" class="card-img-top" alt="Foto Profilo">

            <div class="card-body my-card-body">
              <!-- Nome e cognome -->
              <h5 class="card-title" style="color:#1c3a4a;">Domenico Forlano</h5>
              <!-- Professione -->
              <p class="card-text" style="color:#1c3a4a;">Jr Full Stack Web Developer</p>
              <!-- Profili social -->
              <ul class="list-inline">
                <li class="list-inline-item"><a href="https://www.linkedin.com/in/domenico-forlano-4796bb1b4/"><i class="fa-brands fa-linkedin" style="color:#0077b5;"></i></a></li>
                <li class="list-inline-item"><a href="https://github.com/Dome1992"><i class="fa-brands fa-github"></i></a></li>
              </ul>
            </div>
          </div>
        </swiper-slide>


        <swiper-slide>
          <div class="card my-card">
            <!-- Immagine del profilo -->
            <img src="../assets/images/Tobia-Rigon.jpg" class="card-img-top" alt="Foto Profilo">

            <div class="card-body my-card-body">
              <!-- Nome e cognome -->
              <h5 class="card-title" style="color:#1c3a4a;">Tobia Rigon</h5>
              <!-- Professione -->
              <p class="card-text" style="color:#1c3a4a;">Jr Full Stack Web Developer</p>
              <!-- Profili social -->
              <ul class="list-inline">
                <li class="list-inline-item"><a href="https://www.linkedin.com/in/tobia-rigon-ba0b051a2/"><i class="fa-brands fa-linkedin" style="color:#0077b5;"></i></a></li>
                <li class="list-inline-item"><a href="https://github.com/TobiaRigon"><i class="fa-brands fa-github"></i> </a></li>
              </ul>
            </div>
          </div>
        </swiper-slide>

        <swiper-slide>
          <div class="card my-card">
            <!-- Immagine del profilo -->
            <img src="../assets/images/Giacomo-Agave.jpg" class="card-img-top" alt="Foto Profilo">

            <div class="card-body my-card-body">
              <!-- Nome e cognome -->
              <h5 class="card-title" style="color:#1c3a4a;">Giacomo Agave</h5>
              <!-- Professione -->
              <p class="card-text" style="color:#1c3a4a;">Jr Full Stack Web Developer</p>
              <!-- Profili social -->
              <ul class="list-inline">
                <li class="list-inline-item"><a href="https://www.linkedin.com/in/giacomo-agave-01090b257/"><i class="fa-brands fa-linkedin" style="color:#0077b5;"></i></a></li>
                <li class="list-inline-item"><a href="https://github.com/Jack-170"><i class="fa-brands fa-github"></i> </a></li>
              </ul>
            </div>
          </div>
        </swiper-slide>

        <swiper-slide>
          <div class="card my-card">
            <!-- Immagine del profilo -->
            <img src="../assets/images/Gabr-DiRocco.jpg" class="card-img-top" alt="Foto Profilo">

            <div class="card-body my-card-body">
              <!-- Nome e cognome -->
              <h5 class="card-title" style="color:#1c3a4a;">Gabriele Di Rocco</h5>
              <!-- Professione -->
              <p class="card-text" style="color:#1c3a4a;">Jr Full Stack Web Developer</p>
              <!-- Profili social -->
              <ul class="list-inline">
                <li class="list-inline-item"><a href="https://www.linkedin.com/in/gabriele-di-rocco-6858972b8/"><i class="fa-brands fa-linkedin" style="color:#0077b5;"></i></a></li>
                <li class="list-inline-item"><a href="https://github.com/Gdr0"><i class="fa-brands fa-github"></i> </a></li>
              </ul>
            </div>
          </div>
        </swiper-slide>

        <swiper-slide>
          <div class="card my-card">
            <!-- Immagine del profilo -->
            <img src="../assets/images/Filippo-Cafaro.jpg" class="card-img-top" alt="Foto Profilo">

            <div class="card-body my-card-body">
              <!-- Nome e cognome -->
              <h5 class="card-title" style="color:#1c3a4a;">Filippo Cafaro</h5>
              <!-- Professione -->
              <p class="card-text" style="color:#1c3a4a;">Jr Full Stack Web Developer</p>
              <!-- Profili social -->
              <ul class="list-inline">
                <li class="list-inline-item"><a href="https://www.linkedin.com/in/filippo-cafaro-045aa0290/"><i class="fa-brands fa-linkedin" style="color:#0077b5;"></i></a></li>
                <li class="list-inline-item"><a href="https://github.com/FilippoDibe"><i class="fa-brands fa-github"></i> </a></li>
              </ul>
            </div>
          </div>
        </swiper-slide>
        
        
          ...
          </swiper>
        </div>
         

      </div>

      <div class="row mt-3">
        <div class="col-md-12 text-center">
          <p>&copy; 2024 BoolBnB. Tutti i diritti riservati.</p>
        </div>
      </div>
    </div>
  </footer>
</template>

<style scoped>


/* Stile generale della card */
.my-card {
  width: 300px; /* Larghezza desiderata */
  height: auto; /* Altezza automatica */
  overflow: hidden !important;
  border-color: #1c8aff;
 
}


/* Stile della card-body */
.my-card-body {
  background-color: #f8f9fa; /* Colore di sfondo */
  padding: 20px; /* Spaziatura interna */
  border-radius: 10px; /* Bordi arrotondati */
}

/* Stile per i link LinkedIn e GitHub */
.my-card a i {
  font-size: 22px;
  transition: transform 0.3s ease; /* Aggiungiamo una transizione per l'effetto di ingrandimento */
}

/* Effetto hover per i link LinkedIn e GitHub */
.my-card a i:hover {
  transform: scale(1.3); /* Ingrandiamo il link del 20% al passaggio del mouse */
  
}

i {
  font-size: 20px;
}

#logo {
  width: 60px;
  height: 50px;
}
.footer {
  background-color: #1c3a4a;
  padding: 40px 0;
  
  font-family: 'Poppins', sans-serif; /* Cambio del font principale */
  font-size: 16px; /* Imposta la dimensione del carattere predefinita */
  line-height: 1.5; /* Imposta l'altezza della riga predefinita */
  color: whitesmoke; /* Cambio del colore del testo principale */

}



a {
  color: whitesmoke; /* Colore predefinito per i link */
  text-decoration: none; /* Rimuove il sottolineato predefinito */
}

a:hover {
  color: white; 
  text-decoration: none; /* Rimuove il sottolineato predefinito */
}

.footer h5 {
  color: whitesmoke;
}

.footer ul {
  padding-left: 0;
}

.footer ul li {
  list-style-type: none;
  /* line-height: 1; */
  font-size: 15px;
  color: whitesmoke;
}

.footer  ul li a {
  color:whitesmoke;
}

.footer ul li a:hover {
  color: #007bff;
}

.footer p {
  margin-top: 20px;
  font-size: 12px;
  color:whitesmoke;
  
}
</style>



<script>

   // import Swiper core and required modules
   import {  A11y, Autoplay } from 'swiper/modules';

  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';

  // Import Swiper styles
  import 'swiper/css';
  // import 'swiper/css/navigation';
  // import 'swiper/css/pagination';
  // import 'swiper/css/scrollbar';
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
        modules: [ A11y, Autoplay],
      };
    },
  };
</script>
