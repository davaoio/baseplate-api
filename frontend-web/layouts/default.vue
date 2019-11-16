<template>
  <v-app dark>
    <v-app-bar app absolute elevate-on-scroll>
      <v-toolbar-title>
        <nuxt-link to="/" class="nuxt-style title">Baseplate Web.</nuxt-link>
      </v-toolbar-title>

      <v-spacer></v-spacer>
      <div class="my-2">
        <v-btn text large v-if="isAuthenticated">
          <nuxt-link to="/user/profile" class="nuxt-style">Profile</nuxt-link>
        </v-btn>
        <v-btn text large @click="logout" v-if="isAuthenticated">
          Logout
        </v-btn>
        <v-btn text large v-if="!isAuthenticated">
          <nuxt-link to="/auth/login" class="nuxt-style">Login</nuxt-link>
        </v-btn>
        <v-btn text large v-if="!isAuthenticated">
          <nuxt-link to="/auth/register" class="nuxt-style">Register</nuxt-link>
        </v-btn>
        <v-btn text large>
          <nuxt-link to="/about" class="nuxt-style">About</nuxt-link>
        </v-btn>
      </div>
    </v-app-bar>
    <v-content>
      <v-container>
        <nuxt/>
      </v-container>
    </v-content>
    <v-footer app>
      <span>&copy; 2019</span>
    </v-footer>
  </v-app>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        computed: {
            ...mapGetters(['isAuthenticated', 'loggedInUser'])
        },
        methods: {
            async logout() {
                await this.$auth.logout();
            },
        },
    };
</script>

<style scoped>
  .nuxt-style {
    color: inherit;
    text-decoration: inherit;
  }
  .title {
    font-family: Consolas;
  }
</style>
