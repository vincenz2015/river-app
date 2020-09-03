<template>
  <div id="app">
    <home></home>
  </div>
</template>
<script>
import Home from "./components/Home.vue";
export default {
  name: "app",
  data() {
    return {
      visible: false,
    };
  },
  components: {
    Home,
  },
};
</script>
