<script>
export default {
  name: "Searchbar",
  props: [
    "store",
    "autoComplete",
    "search",
    "showAutoComplete",
    "AutoMenu",
    "selectItem",
  ],
};
</script>

<template>
  <form class="form-inline my-2 gap-2 d-flex" @submit="handleSearch">
    <input
      class="form-control mr-sm-2"
      type="search"
      placeholder="Cerca"
      aria-label="Search"
      v-model="store.findApartment"
      @input="autoComplete"
    />
    <router-link
      :to="'/search/'"
      @click="search()"
      class="btn my_btn my-sm-0"
      type="submit"
    >
      Trova
    </router-link>

    <!-- Inizio: Elemento per l'autocompletamento -->
    <div
      id="AutoComplete"
      style="margin-top: 40px"
      class="card position-absolute w-80 h-50 radius"
      v-show="
        showAutoComplete &&
        AutoMenu.length > 0 &&
        store.findApartment.trim() !== ''
      "
    >
      <ul class="list" style="cursor: pointer">
        <li
          v-for="(item, index) in AutoMenu"
          :key="index"
          @click="selectItem(item)"
        >
          {{ item.address.freeformAddress }}
        </li>
      </ul>
    </div>
    <!-- Fine: Elemento per l'autocompletamento -->
  </form>
</template>

<style scoped>
.form-control {
  max-width: 100%; /* Larghezza massima al 100% */
  width: 100%; /* Larghezza al 100% */
  min-width: 200px; /* Larghezza minima */
}
.my_btn {
  background-color: #63beec;
  color: white;
  font-weight: bold;
}
</style>
