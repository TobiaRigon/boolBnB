<template>
  <main>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="col">
            <h1>Cerca il tuo appartamento</h1>
          </div>
        </div>
      </div>
      <form class="form-inline my-2 gap-2 d-flex">
        <input
          class="form-control mr-sm-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          Search
        </button>
      </form>
    </div>
  </main>
</template>

<style>
.form-control {
  max-width: 50%;
  min-width: 700px;
}
</style>
