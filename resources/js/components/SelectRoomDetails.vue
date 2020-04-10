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
        <td class="sl">1.</td>
        <td class="text-muted" v-text="roomType.title"></td>
        <td>
          <template v-for="rooms in roomType.rooms">
             <select-room :room="rooms.number" :room-id="rooms.id" :price-per-night="roomType.base_price" v-on:select-room="selectRoom"></select-room>
            </template>
          </div>
        </td>
        <td>
          <select id="inputGroupSelect01" class="custom-select">
            <option selected="selected" disabled="disabled">Choose...</option>
            <option value="no_tax">No tax</option>
            <option v-for="tax in taxes" :value="tax.id" :key="tax.id">{{tax.name}}</option>
          </select>
        </td>
        <td>
          <div class="col-md-7"></div>
          <div class="col-md-5 float-right">
            <span class="d-inline h3">₹&nbsp;</span>
            <input
              type="text"
              name="price_per_night[]"
              :value="roomType.base_price"
              class="form-control d-inline"
            />
          </div>
          </div>
        </td>
         <td>
          <div class="col-md-7"></div>
          <div class="col-md-5 float-right">
            <span class="d-inline h3">₹&nbsp;</span>
            <input
              type="text"
              name="price"
              :value="price"
              class="form-control d-inline"
            />
          </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import SelectRoom from "./SelectRoom";
export default {
  props: ["roomTypes", "taxes"],
    components: { SelectRoom },
    data(){
      return {
       selected:[],
      }
    },
    methods: {
      selectRoom(room, price) {
        console.log(price);
        
         if (!this.selected.includes(room)) {
                this.selected.push(room);
                price = parseInt(price);
                this.price.push(price);
            } else {
                this.selected.pop(room);
            }

            console.log(this.selected);
            this.$emit("select-room", room);
        }
    },
    computed: {
       price:{
         
       }
    }
};
</script>