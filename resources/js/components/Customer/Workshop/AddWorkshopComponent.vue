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
          placeholder="Workshop Name"
        />
      </div>
     
    </div>

    <h3>Address Information</h3>
    <input type="checkbox" v-model="isSameAsHQAddress">
    Same as HQ
    <div class="form-group">
      <label>Street</label>
      <input :value="isSameAsHQAddress ? customer.street : ''" name="street" type="text" class="form-control" placeholder="1234 Main St" />
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>City</label>
        <input :value="isSameAsHQAddress ? customer.city : ''" name="city" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-4">
        <label>State</label>
        <input :value="isSameAsHQAddress ? customer.state : ''" name="state" type="text" class="form-control" />
      </div>
      <div class="form-group col-md-2">
        <label>Zip</label>
        <input :value="isSameAsHQAddress ? customer.zip : ''" name="zip" type="text" class="form-control" />
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
    props: ['customer'],
  mounted() {
    console.log("Component mounted.");
  },
  data() {
      return {
          isSameAsHQAddress: false
      }
   
  }
};
</script>
