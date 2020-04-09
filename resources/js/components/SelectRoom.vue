<template>
  <div>
    <h1>
      {{message}}
      <slot></slot>
    </h1>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: "Hello world"
    };
  }
};
</script>

<style>
</style>