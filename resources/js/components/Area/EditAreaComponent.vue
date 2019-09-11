<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label>Name *</label>
        <input
          required="required"
          name="name"
          type="text"
          class="form-control"
          placeholder="Area Name"
          v-model="newArea.name"
        />
      </div>
    </div>

    <h3>Address Information</h3>
    <div class="form-group">
      <label>Street</label>
      <input v-model="newArea.street" name="street" type="text" class="form-control" placeholder="1234 Main St" />
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>City</label>
        <input v-model="newArea.city" name="city" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-4">
        <label>State</label>
        <input v-model="newArea.state" name="state" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-2">
        <label>Zip</label>
        <input  v-model="newArea.zip" name="zip" type="text" class="form-control" />
      </div>
    </div>
  </div>
</template>

    <script>
export default {
    props: ["area"],
  mounted() {
    console.log("Component mounted.");
    this.newArea  = this.area
  },
  data() {
      return {
          newArea: {}
      }
  }
};
</script>
