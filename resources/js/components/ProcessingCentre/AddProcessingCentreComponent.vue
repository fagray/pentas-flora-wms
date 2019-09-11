<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Name *</label>
        <input
          required="required"
          name="name"
          type="text"
          class="form-control"
          placeholder="Processing Centre Name"
        />
      </div>
      <div class="form-group col-md-6">
        <label>Phone #</label>
        <input
          required="required"
          name="phone_number"
          type="text"
          class="form-control"
          placeholder="Phone #"
        />
      </div>
    </div>

    <h3>Address Information</h3>
    <div class="form-group">
      <label>Street</label>
      <input name="street" type="text" class="form-control" placeholder="1234 Main St" />
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>City</label>
        <input name="city" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-4">
        <label>State</label>
        <input name="state" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-2">
        <label>Zip</label>
        <input name="zip" type="text" class="form-control" />
      </div>
    </div>
  </div>
</template>

    <script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      selectedRole: null
    };
  }
};
</script>
