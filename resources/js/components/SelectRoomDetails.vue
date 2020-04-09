<template>
<div>
<tbody>
    <tr>

        <td class="price-per-night p-0">
            <table class="table table-sm borderless mb-0 ">
                <thead class="font-weight-bold">
                    <div id="app">

                    </div>
                    <tr>
                        <td class="sl">#</td>
                        <td>Room type</td>
                        <td>Available Rooms</td>
                        <td>Tax</td>
                        <td class="text-right">Price/Night</td>
                    </tr>
                </thead>

                <tbody>  
                        <tr v-for="roomType in roomTypes" :key="roomType.id">
                        <td class="sl">1.</td>
                        <td class="text-muted">{{roomType.title}}</td>
                        <td>
                            <div>
                              <slot name="rooms"></slot>
                            </div>
                        </td>

                        <td>
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected disabled>Choose...</option>
                                <option value="no_tax">No tax</option>


                                <option v-for="tax in taxes" :key="tax.id" :value="tax.id">{{tax.name}}</option>
                               
                            </select>
                        </td>

                         <td class="float-right">
                            <div class="col-md-7">

                            </div>
                            <div class="col-md-5 float-right">
                                <span class="d-inline h3">₹&nbsp;</span><input type="text" name="" id=""
                                    class="form-control d-inline" :value="roomType.base_price">
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>


        </td>
    </tr>
</tbody>
</div>
</template>

<script>
export default {
    props:["roomTypes","taxes"],
}
</script>