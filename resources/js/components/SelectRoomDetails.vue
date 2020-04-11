<template>
   <fragment>
        <td class="sl">1.</td>
        <td class="text-muted" v-text="roomType.title"></td>
        <td>
          <template v-for="rooms in roomType.rooms">
             <select-room v-if="dataLoaded" :room="rooms.number" :room-id="rooms.id" :price-per-night.sync="roomType.base_price" v-on:select-room="selectRoom"></select-room>
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
          <price-per-night :room-type-base-price="roomType.base_price" v-on:change-price="changePrice"></price-per-night>
        </td>
         <td>
          <div class="col-md-7"></div>
          <div class="col-md-5 float-right">
            <span class="d-inline h3">₹&nbsp;</span>
            <input
              type="text"
              name="price"
              :value="pp"
              class="form-control d-inline"
            />
          </div>
          </div>
        </td>
         </fragment>
</template>

<script>
import SelectRoom from "./SelectRoom";
import PricePerNight from "./PricePerNight";
import moment from 'moment';
export default {
    props:["roomType","taxes", "guestCheckIn", "guestCheckOut"],
    components:{SelectRoom,PricePerNight},
    data() {
        return {
   selected:[],
    price:[],
    dataLoaded:true,
    pp: 0
        }
    },
    methods:{
 selectRoom(room,price) {
      if (!this.selected.includes(room)) {
        this.selected.push(room);
        // this.price.push(price);
        
      } else {
        this.selected.pop(room);
        // this.price.pop(price);
      }
      
      this.totalPrice(this.roomType.base_price); 
      console.log(this.guestCheckIn);
      this.$emit("select-room", room);
    },
    
    totalPrice(base_price) {
      if(this.selected.length > 0) {
           let price = base_price*this.selected.length;
            let startDate = moment(this.guestCheckIn, "DD.MM.YYYY");
            let endDate = moment(this.guestCheckOut, "DD.MM.YYYY");

            let result = endDate.diff(startDate, 'days');
            let days = parseInt(result);
            this.pp = price*days;
      }else {
        this.pp = 0
      }
            
        },
        changePrice(price) {
      this.roomType.base_price = price
      this.totalPrice(price);   
    }
    },
    computed: {
      
    }
}
</script>