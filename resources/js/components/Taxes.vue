<template>
  <fragment>
    <td>
      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-7">
          <select
            id="inputGroupSelect01"
            class="custom-select"
            v-model="selected"
            @change="selectTax"
          >
            <option disabled="disabled">Choose...</option>
            <option value="0" selected>No tax</option>
            <fragment v-for="tax in taxes" :key="tax.id">
              <option :value="tax.id" :key="tax.id" v-text="tax.name"></option>
            </fragment>
          </select>
        </div>
      </div>
    </td>
  </fragment>
</template>



<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
export default {
  props: ["taxes"],
  data() {
    return {
      selected: 0
    };
  },
  methods: {
    selectTax() {
      console.log(this.selected);
      this.$emit("select-tax", this.selected);
    }
  },
  mounted() {
    console.log(this.taxes);
  },
  computed: {}
};
</script>
