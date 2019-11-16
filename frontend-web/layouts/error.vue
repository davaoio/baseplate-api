<template>
  <v-app dark>
    <div class="centered">
      <h1 v-if="error.statusCode === 404">{{ pageNotFound }}</h1>
      <h1 v-else>{{ otherError }}</h1>
      <v-btn large>
        <NuxtLink to="/" class="nuxt-style">Home page</NuxtLink>
      </v-btn>
    </div>
  </v-app>
</template>

<script>
    export default {
        layout: "empty",
        props: {
            error: {
                type: Object,
                default: null
            }
        },
        head() {
            const title =
                this.error.statusCode === 404 ? this.pageNotFound : this.otherError;
            return {
                title
            };
        },
        data() {
            return {
                pageNotFound: "404 Not Found",
                otherError: "An error occurred"
            };
        }
    };
</script>

<style scoped>
  .nuxt-style {
    color: inherit;
    text-decoration: inherit;
  }

  .centered {
    left: 0;
    line-height: 200px;
    margin-top: -100px;
    position: absolute;
    text-align: center;
    top: 30%;
    width: 100%;
  }
</style>
