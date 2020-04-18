<template>
  <div class="d-inline">
    <button type="button" :class="classname" @click="selectRoom">{{room}}</button>
  </div>
</template>

<script>
export default {
  props: ["room", "roomId", "price-per-night", "roomTypeId"],
  data() {
    return {
      classname: "btn btn-outline-success btn-sm ml-2",
      selected: 0
    };
  },
  methods: {
    selectRoom() {
      if (this.selected == 0) {
        this.classname = "btn btn-success btn-sm ml-2";
        this.selected = 1;
      } else {
        this.classname = "btn btn-outline-success btn-sm ml-2";
        this.selected = 0;
      }

      this.$emit("select-room", this.roomId, this.roomTypeId);
      // this.$emit("total-price", this.roomTypeId);
    }
  },
  computed: {}
};
</script>

<style>
</style>