<template>
  <!-- Form per inviare un messaggio al proprietario -->
  <form @submit.prevent="sendMessage">
    <div class="container mt-5">
      <h2>Contatta il proprietario:</h2>
      <div class="mb-3">
        <label for="sender_name" class="form-label">Nome</label>
        <input
          type="text"
          class="form-control"
          id="sender_name"
          v-model="newMessage.sender_name"
          required
        />
      </div>

      <div class="mb-3">
        <label for="sender_surname" class="form-label">Cognome</label>
        <input
          type="text"
          class="form-control"
          id="sender_surname"
          v-model="newMessage.sender_surname"
          required
        />
      </div>

      <div class="mb-3">
        <label for="sender_mail" class="form-label">Mail</label>
        <input
          type="text"
          class="form-control"
          id="sender_mail"
          v-model="newMessage.sender_mail"
          required
        />
      </div>

      <div class="mb-3">
        <label for="sender_text" class="form-label">Messaggio</label>
        <textarea
          class="form-control"
          id="sender_text"
          v-model="newMessage.sender_text"
          required
        ></textarea>
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
    // Funzione per ottenere la data e l'ora nel formato 'YYYY-MM-DD HH:MM:SS'
    function getCurrentDateTime() {
      const today = new Date();
      const year = today.getFullYear();
      let month = today.getMonth() + 1;
      let day = today.getDate();
      let hours = today.getHours();
      let minutes = today.getMinutes();
      let seconds = today.getSeconds();

      // Aggiungi zero iniziale se il mese è inferiore a 10
      if (month < 10) {
        month = "0" + month;
      }

      // Aggiungi zero iniziale se il giorno è inferiore a 10
      if (day < 10) {
        day = "0" + day;
      }

      // Aggiungi zero iniziale se l'ora è inferiore a 10
      if (hours < 10) {
        hours = "0" + hours;
      }

      // Aggiungi zero iniziale se i minuti sono inferiori a 10
      if (minutes < 10) {
        minutes = "0" + minutes;
      }

      // Aggiungi zero iniziale se i secondi sono inferiori a 10
      if (seconds < 10) {
        seconds = "0" + seconds;
      }

      return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    return {
      newMessage: {
        apartment_id: this.$route.params.id,
        sender_text: "",
        date: getCurrentDateTime(), // Ottieni la data odierna
        sender_mail: "",
        sender_name: "",
        sender_surname: "",
      },
    };
  },
  methods: {
    sendMessage() {
      console.log("submit with:", this.newMessage);

      axios
        .post(
          "http://localhost:8000/api/apartmentApi/messages",
          this.newMessage
        )
        .then((res) => {
          const data = res.data;
          console.log(data);

          // if (data.status == "success") {
          //   this.messages.push(data.message);
          // }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
.my_card {
  max-width: 1000px;
  height: 100%;
}
</style>
