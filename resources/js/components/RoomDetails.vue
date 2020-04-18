<template>
  <table class="table table-sm borderless mb-0">
    <thead class="font-weight-bold">
      <tr>
        <td class="sl">#</td>
        <td>Room type</td>
        <td>Available Rooms</td>
        <td class="text-right">Price/Night</td>
        <td class="text-right">Tax</td>

        <td class="text-right">Price</td>
        <td class="text-right">Tax Added</td>
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
          v-on:change-price="changePrice"
        ></select-room-details>
      </tr>
      <tr class="mt-3">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

        <!-- <td class="display-2">Sum: {{this.totalPrice}}</td> -->
      </tr>
    </tbody>
    <input type="hidden" name="rooms" :value="selected" />
  </table>
</template>

<script>
import SelectRoomDetails from "./SelectRoomDetails.vue";
export default {
  props: ["roomTypes", "taxes", "guestCheckIn", "guestCheckOut"],
  components: { SelectRoomDetails },
  data() {
    return {
      selected: [],
      totalPrice: 0,
      totalTax: 0,
      arrayPrice: []
    };
  },
  methods: {
    selectRoom(room, roomTypeId, total) {
      if (this.selected.includes(room) == false) {
        this.selected.push(room);
      } else {
        this.selected.pop(room);
      }
      this.$emit("select-room", room);
    },
    changePrice(price, roomTypeId) {
      let roomType = this.roomTypes.find(roomType => roomType.id == roomTypeId);
      roomType.base_price = price;
      this.roomTypes = this.roomTypes;
    }
  },
  computed: {}
};
</script>