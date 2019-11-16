<template>
  <div>
    <v-layout column justify-center align-center>
      <v-flex xs12 sm8 md6>
        <div class="text-center">
          <h1>Baseplate Web.</h1>
        </div>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
    export default {
        head() {
            return {
                title: "Baseplate API"
            }
        },
    };
</script>

<style scoped>
  h1 {
    left: 0;
    line-height: 200px;
    margin-top: -100px;
    position: absolute;
    text-align: center;
    top: 50%;
    width: 100%;
    font-size: 200px;
    font-family: 'Consolas';
  }
</style>
