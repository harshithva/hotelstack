<template>
  <table class="table table-sm borderless mb-0">
    <thead class="font-weight-bold">
      <tr>
        <td class="sl">#</td>
        <td>Room type</td>
        <td>Available Rooms</td>
        <td>Tax</td>
        <td class="text-right">Price/Night</td>
        <td class="text-right">Price</td>
      </tr>
    </thead>
    <tbody>
      <tr v-for="roomType in roomTypes" :key="roomType.id">
        <select-room-details
          :room-type="roomType"
          :taxes="taxes"
          :guest-check-in="guestCheckIn"
          :guest-check-out="guestCheckOut"
          v-on:select-room="selectRoom"
        ></select-room-details>
      </tr>
    </tbody>
  </table>
</template>

<script>
import SelectRoomDetails from "./SelectRoomDetails.vue";
export default {
  props: ["roomTypes", "taxes", "guestCheckIn", "guestCheckOut"],
  components: { SelectRoomDetails },
  data() {
    return {
      selected: []
    };
  },
  methods: {
    selectRoom(room) {
      if (!this.selected.includes(room)) {
        this.selected.push(room);
      } else {
        this.selected.pop(room);
      }

      console.log(this.selected);
      this.$emit("select-room", room);
    }
  },
  computed: {}
};
</script>