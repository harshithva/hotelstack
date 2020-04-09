<template>
  <div class="d-inline">
    <button type="button" :class="classname" @click="selectRoom">{{room}}</button>
  </div>
</template>

<script>
export default {
  props: ["room"],
  data() {
    return {
      message: "Hello world",
      classname: "btn btn-outline-success btn-sm"
    };
  },
  methods: {
    selectRoom() {
      if (this.classname == "btn btn-outline-success btn-sm") {
        this.classname = "btn btn-success btn-sm";
      } else this.classname = "btn btn-outline-success btn-sm";
    }
  }
};
</script>

<style>
</style>