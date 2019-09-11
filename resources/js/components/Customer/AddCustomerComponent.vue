<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label>Display Name *</label>
        <input
          required="required"
          name="display_name"
          type="text"
          class="form-control"
          placeholder="Company Name/Full name"
        />
      </div>
      <div class="form-group col-md-4">
        <label>Customer Type *</label>
            <select name="type" class="form-control">
                <option value="DT">DT (Non-Contractual / Random)</option>
                <option value="SW">SW (Contractual)</option>
            </select>
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

    <h3>Contact Information</h3>
    
    <div class="form-row">
      <div class="form-group col-md-4">
        <label>Contact #</label>
        <input name="contact_no" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-4">
        <label>Email</label>
       <input name="email" type="email" class="form-control" />
      </div>
      <div class="form-group col-md-4">
        <label>Fax</label>
        <input name="fax" type="text" class="form-control" />
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
   
  }
};
</script>
