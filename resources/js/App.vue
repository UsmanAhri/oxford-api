<template>
  <div class="container">
    <nav class="nav">
      <router-link to="/" class="nav__link">
        <ui-button :raised="true">Home</ui-button>
      </router-link>
      <router-link to="/ru" class="nav__link">
        <ui-button :raised="true">Russian</ui-button>
      </router-link>
      <router-link to="/es" class="nav__link">
        <ui-button :raised="true">Spanish</ui-button>
      </router-link>
    </nav>
    <main class="main-content">
      <router-view />
    </main>
  </div>
</template>

<script>

</script>

<style>

</style>