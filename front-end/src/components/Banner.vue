<script>
export default {
  name: "Banner",
};
</script>

<template>
  <div class="container text-center my-5">
    <div class="row justify-content-center my_rounded bg-white shadow-lg">
      <div class="col-md-4">
        <div class="text-center p-4">
          <i class="fa-solid fa-earth-americas fa-3x"></i>
          <h5 class="font-weight-bold mt-4 mb-3">
            Trova i migliori appartamenti in affitto
          </h5>
          <p class="mb-4 text-muted">
            Utilizza la nostra ricerca geografica e i filtri avanzati per
            trovare l'appartamento perfetto per le tue esigenze di affitto.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="text-center p-4">
          <i class="fa-solid fa-house fa-3x"></i>

          <h5 class="mt-4 mb-3">
            Fatti ispirare dagli appartamenti consigliati
          </h5>
          <p class="mb-4 text-muted">
            Sfoglia le nostre selezioni curate di appartamenti in affitto e
            lasciati ispirare per il tuo prossimo soggiorno.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="text-center p-4">
          <i class="fa-solid fa-user-check fa-3x"></i>
          <h5 class="mt-4 mb-3">Contatta direttamente il proprietario</h5>
          <p class="mb-4 text-muted">
            Contatta direttamente i proprietari degli appartamenti senza
            mediazioni, rendendo il processo di affitto diretto e trasparente.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.my_rounded {
  border-radius: 30px;
}
</style>
