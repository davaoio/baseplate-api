<template>
  <div>
    <h1>About.</h1>
  </div>
</template>

<script>
    export default {
        name: "about",
        head() {
            return {
                title: "About - Baseplate API"
            }
        },
    }
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
