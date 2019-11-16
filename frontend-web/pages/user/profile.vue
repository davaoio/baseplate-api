<template>
  <section class="section">
    <div class="container">
      <h2 class="title">My Profile</h2>
      <hr>
      <div class="content">
        <p><strong>First Name:</strong>{{ loggedInUser.first_name }}</p>
        <p><strong>Last Name:</strong>{{ loggedInUser.last_name }}</p>
        <p><strong>Email:</strong>{{ loggedInUser.email }}</p>
      </div>
    </div>
  </section>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        middleware: 'auth',
        name: "profile",
        computed: {
            ...mapGetters(['loggedInUser'])
        }
    }
</script>

<style scoped>

</style>
