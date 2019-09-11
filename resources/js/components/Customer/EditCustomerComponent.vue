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
          v-model="newCustomer.display_name"
        />
      </div>
      <div class="form-group col-md-4">
        <label>Customer Type *</label>
            <select name="type" class="form-control" v-model="newCustomer.type">
                <option value="DT">DT (Non-Contractual / Random)</option>
                <option value="SW">SW (Contractual)</option>
            </select>
      </div>
     
    </div>

    <h3>Address Information</h3>
    <div class="form-group">
      <label>Street</label>
      <input v-model="newCustomer.street" name="street" type="text" class="form-control" placeholder="1234 Main St" />
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>City</label>
        <input v-model="newCustomer.city" name="city" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-4">
        <label>State</label>
        <input v-model="newCustomer.state" name="state" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-2">
        <label>Zip</label>
        <input v-model="newCustomer.zip" name="zip" type="text" class="form-control" />
      </div>
    </div>

    <h3>Contact Information</h3>
    
    <div class="form-row">
      <div class="form-group col-md-4">
        <label>Contact #</label>
        <input v-model="newCustomer.contact_no" name="contact_no" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-4">
        <label>Email</label>
       <input v-model="newCustomer.email" name="email" type="email" class="form-control" />
      </div>
      <div class="form-group col-md-4">
        <label>Fax</label>
        <input v-model="newCustomer.fax" name="fax" type="text" class="form-control" />
      </div>
    </div>
    
  </div>
</template>

    <script>
export default {
    props: ["customer"],
  mounted() {
    console.log("Component mounted.");
    this.newCustomer = this.customer
  },
  data() {
   return {
       newCustomer: null
   }
  }
};
</script>
