<template>
  <div>
    <h2>{{ guest }}</h2>
  </div>
</template>

<script>
export default {
  data: {
    guest: "Vinyas"
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
