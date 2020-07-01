<template>
  <div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-lg">Guest Name</span>
        </div>
        <input
          type="text"
          class="form-control"
          aria-label="Sizing example input"
          aria-describedby="inputGroup-sizing-lg"
          :value="guestName"
          name="guest"
        />
        <input type="hidden" :value="guestId" name="user_id" />
      </div>
    </div>

    <div class="form-row justify-content-center mt-3">
      <div class="form-group col-md-3">
        <div class="form-group">
          <label for="example-number-input" class="form-control-label">&nbsp;Adults</label>
          <input
            class="form-control"
            type="number"
            id="example-number-input"
            name="adults"
            :value="guestAdults"
          />
        </div>
      </div>

      <div class="form-group col-md-3">
        <div class="form-group">
          <label for="example-number-input" class="form-control-label">&nbsp;Kids</label>
          <input
            class="form-control"
            type="number"
            id="example-number-input"
            name="kids"
            :value="guestKids"
          />
        </div>
      </div>

      <div class="form-group col-md-3">
        <h5>&nbsp;Check in</h5>
        <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="ni ni-calendar-grid-58"></i>
              </span>
            </div>
            <input
              name="check_in"
              class="form-control datepicker"
              placeholder="Select date"
              type="text"
              :value="guestCheckIn"
              disabled
            />
          </div>
        </div>
      </div>

      <div class="form-group col-md-3">
        <h5>&nbsp;Check out</h5>
        <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="ni ni-calendar-grid-58"></i>
              </span>
            </div>
            <input
              name="check_out"
              class="form-control datepicker"
              placeholder="Select date"
              type="text"
              :value="guestCheckOut"
              disabled
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "guestName",
    "guestId",
    "guestAdults",
    "guestKids",
    "guestCheckIn",
    "guestCheckOut"
  ],
  data() {
    return {};
  },
  methods: {}
};
</script>