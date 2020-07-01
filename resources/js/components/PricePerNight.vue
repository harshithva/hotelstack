<template>
<fragment>
    <div class="col-md-7"></div>
          <div class="col-md-5 float-right">
            <span class="d-inline h3">₹&nbsp;</span>
            <input
              type="text"
              name="price_per_night[]"
              class="form-control d-inline"
              v-model="price"
              @keyup="changePrice"
              autocomplete="off" 
            />
          </div>
          </div>
          </fragment>
</template>

<script>
export default {
    props:["roomTypeBasePrice"],
    data() {
        return{
            price:this.roomTypeBasePrice
        }
    },
    methods: {
        changePrice() {
            this.$emit("change-price",this.price)
        }
    }
}
</script>