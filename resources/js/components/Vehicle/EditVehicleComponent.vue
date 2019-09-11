<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label>Plate No *</label>
        <input
          required="required"
          v-model="newVehicle.plate_no"
          type="text"
          class="form-control"
          placeholder="Plate no"
        />
      </div>
    </div>    
    <div class="form-row">
         <div class="form-group col-md-8">
        <label>Name *</label>
        <input
        required="required"
          placeholder="Vehicle Name/model/make"
          id="input"
          class="form-control"
          v-model="newVehicle.name"
        />
      </div>
      <input type="hidden" name="name" :value="newVehicle.name">
      <input type="hidden" name="plate_no" :value="newVehicle.plate_no">
    </div>
  </div>
</template>

    <script>

export default {
  props: ["vehicle"],
  mounted() {
    console.log("Component mounted.");
    this.newVehicle = this.vehicle
  },
  data() {
    return {
        newVehicle: {
            name: null, 
            plate_no: null
        }
    }
  }
};
</script>
