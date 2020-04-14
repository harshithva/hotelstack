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
          <price-per-night :room-type-base-price="roomType.base_price" v-on:change-price="changePrice"></price-per-night>
        </td>
         <taxes :taxes="taxes" v-on:select-tax="addTax"></taxes>
        
         <td>
          <div class="col-md-7"></div>
          <div class="col-md-5 float-right">
            <span class="d-inline h3">₹&nbsp;</span>
            <input
              type="text"
              name="price"
              :value="roomtype_net_price"
              class="form-control d-inline" disabled
            />
          </div>
          </div>
        </td>
        <td>
          <p>+ {{this.taxPrice}}</p>
        </td>
         </fragment>
</template>

<script>
import SelectRoom from "./SelectRoom";
import PricePerNight from "./PricePerNight";
import Taxes from "./Taxes";
import moment from 'moment';
export default {
    props:["roomType","taxes", "guestCheckIn", "guestCheckOut"],
    components:{SelectRoom,PricePerNight,Taxes},
    data() {
        return {
   selected:[],
    price:[],
    dataLoaded:true,
    roomtype_net_price: 0,
    selectedTax:[],
    taxPrice:0
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
      this.$emit("select-room", room);
    },
    
    totalPrice(base_price) {
      if(this.selected.length > 0) {
           let price = base_price*this.selected.length;
            let startDate = moment(this.guestCheckIn, "DD.MM.YYYY");
            let endDate = moment(this.guestCheckOut, "DD.MM.YYYY");

            let result = endDate.diff(startDate, 'days');
            let days = parseInt(result);
            this.roomtype_net_price = price*days;     
            let tax = this.taxes.find(taxes => taxes.id == this.selectedTax);     
            if(tax)
            {
                let newPrice = this.getTax(tax, this.roomtype_net_price);
                console.log(newPrice);
                this.taxPrice = newPrice;
            }
            else
            {
              this.taxPrice = 0;
            }
      }
      else
      {
        this.roomtype_net_price = 0
      }
            
        },
        changePrice(price) {
      this.roomType.base_price = price
      this.totalPrice(price);   
    },
    addTax(taxId) {
      if(taxId == 0) {
       this.taxPrice = 0;
       this.selectedTax = [];
       return;
      }
      
      let tax = this.taxes.find(tax => tax.id === taxId);
      if(tax) {
        this.selectedTax = tax.id;
        let newPrice = this.getTax(tax, this.roomtype_net_price);
        this.taxPrice = newPrice;
      }
      
    },
    getTax(tax, net_price) {
      console.log(tax);
      
      if(tax) {     
      this.taxPrice = 0;
      if(net_price >= tax.amount_1){
        return (net_price/100) * tax.rate_1;
        
      }else if(net_price >= tax.amount_2){
       return (net_price/100) * tax.rate_2;
      }
      else
      {  
        return 0;
      }
      }
     
    }
    },
    computed: {
      
    }
}
</script>