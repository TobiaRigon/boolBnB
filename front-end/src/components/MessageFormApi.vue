<template>
    <!-- Form per inviare un messaggio al proprietario -->
    <form @submit.prevent="inviaMessaggio">
      <div class="container mt-5">
        <h2>Contatta il proprietario:</h2>
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" v-model="message.nome" required>
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
        message: {
          nome: '',
          testo: '',
        }
      };
    },
    methods: {
      inviaMessaggio() {
        // Metodo per l'invio del messaggio
        console.log('Messaggio inviato:', this.message);
  
        // Effettua una richiesta POST al backend
        axios.post('http://localhost:8000/dashboard', this.message)
          .then((res) => {
            console.log(res.data);
            // Azzera i campi del form dopo l'invio
            this.message.nome = '';
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