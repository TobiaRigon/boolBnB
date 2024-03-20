<template>
    <!-- Form per inviare un messaggio al proprietario -->
    <form @submit.prevent="inviaMessaggio" action="/api/messages" method="POST">
      <div class="container mt-5">

        <h2>Contatta il proprietario:</h2>
         <!-- Campo nascosto per l'ID dell'appartamento -->
      <input type="hidden" name="apartment_id" v-model="apartmentId">

        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" v-model="message.nome" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="message.email" required>
        </div>

        <div class="mb-3">
          <label for="object" class="form-label">Oggetto</label>
          <input type="text" class="form-control" id="object" v-model="message.object" required>
        </div>
        
        <div class="mb-3">
          <label for="testo" class="form-label">Messaggio</label>
          <textarea class="form-control" id="testo" v-model="message.testo" required></textarea>
        </div>
  
        <button type="submit" class="btn btn-primary">Invia Messaggio</button>
      </div>
    </form>
  </template>
  
<script>
  import axios from "axios";
  
  export default {
    name: "MessageFormApi",
    data() {
      return {
        apartmentId: '', // Aggiunto il campo apartmentId
        message: {
          nome: '',
          email: '',
          object: '',
          testo: '',
        }
      };
    },
    methods: {
      inviaMessaggio() {
        // Metodo per l'invio del messaggio
        console.log('Messaggio inviato:', this.message);
  
        // Effettua una richiesta POST al backend
        axios.post('/api/messages', {...this.message, apartment_id: this.apartmentId})
          .then((res) => {
            console.log(res.data);
            // Azzera i campi del form dopo l'invio
            this.message.nome = '';
            this.message.email = '';
            this.message.object = '';
            this.message.testo = '';
          })
          .catch((err) => {
            console.error(err);
          });
      }
    }
  };
</script>
  
  <style scoped>
  .my_card {
    max-width: 1000px;
    height: 100%;
  }
  </style>