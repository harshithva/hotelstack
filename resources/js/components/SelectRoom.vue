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
      classname: "btn btn-outline-success btn-sm",
      selected: 0
    };
  },
  methods: {
    selectRoom() {
      if (this.selected == 0) {
        this.classname = "btn btn-success btn-sm";
        this.selected = 1;
      } else {
        this.classname = "btn btn-outline-success btn-sm";
        this.selected = 0;
      }
      this.$emit("select-room", this.room);
    }
  }
};
</script>

<style>
</style>