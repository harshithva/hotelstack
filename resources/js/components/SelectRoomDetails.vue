<template>
   <fragment>
        <td class="sl">1.</td>
        <td class="text-muted" v-text="roomType.title"></td>
        <td>
          <template v-for="rooms in roomType.rooms">
             <select-room :room="rooms.number" :room-id="rooms.id" :price-per-night="roomType.base_price" v-on:select-room="selectRoom"></select-room>
            </template>
          
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
              :value="totalPrice"
              class="form-control d-inline"
            />
          </div>
          </div>
        </td>
         </fragment>
</template>

<script>
import SelectRoom from "./SelectRoom";
import moment from 'moment';
export default {
    props:["roomType","taxes", "guestCheckIn", "guestCheckOut"],
    components:{SelectRoom},
    data() {
        return {
   selected:[],
    price:[]
        }
    },
    methods:{
 selectRoom(room,price) {
      if (!this.selected.includes(room)) {
        this.selected.push(room);
        this.price.push(price);
      } else {
        this.selected.pop(room);
        this.price.pop(price);
      }
      
      console.log(this.guestCheckIn);
      this.$emit("select-room", room);
    }
    },
    computed: {
        totalPrice: function() {
            let price = this.price.reduce((a, b) => a + b, 0);
            let startDate = moment(this.guestCheckIn, "DD.MM.YYYY");
            let endDate = moment(this.guestCheckOut, "DD.MM.YYYY");

            let result = endDate.diff(startDate, 'days');
            let days = parseInt(result);
             return price*days;
        }
    }
}
</script>