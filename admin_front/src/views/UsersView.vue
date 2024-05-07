<template>
  <div id="main-wrapper">
    <Navigation />

    <Sidebar />

    <div class="main-content">
      <section class="section">
        <div class="section-header justify-content-between">
          <h1>Quản lý User</h1>
        </div>
        <MainContent></MainContent>
      </section>
    </div>
  </div>
</template>

<script>
import Sidebar from '../components/Sidebar.vue';
import Navigation from '../components/Nav.vue';
import MainContent from '../components/MainContent.vue';

export default {
  components: {
    Navigation,
    Sidebar,
    MainContent
  }
}
</script>

<style></style>