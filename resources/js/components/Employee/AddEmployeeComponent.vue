<template>
  <div>
    <h5>Choose the employee's role:</h5>
    <div class="row role-selection" style="padding:20px;">
      <div class="col-md-4">
        <input
          v-model="selectedRole"
          type="radio"
          name="role"
          id="employee"
          class="input-hidden"
          :value="'normal'"
        />

        <label for="employee">
          <img src="//img.icons8.com/ios/100/000000/conference-call.png" alt="Normal employee" />
          <p class="font-weight-bold" style="padding:10px;">Normal Employee</p>
          <p class="text-muted">A normal employee. Purpose is for keeping records only.</p>
        </label>
      </div>
      <div class="col-md-4">
        <input
          type="radio"
          name="role"
          v-model="selectedRole"
          :value="'driver'"
          id="driver"
          class="input-hidden"
        />
        <label for="driver">
          <img src="//img.icons8.com/ios/100/000000/name.png" alt="Driver" />
          <p class="font-weight-bold" style="padding:10px;">Driver</p>
          <p class="text-muted">For accessing the mobile application & their web section.</p>
        </label>
      </div>
      <div class="col-md-4">
        <input
          type="radio"
          name="role"
          v-model="selectedRole"
          :value="'admin'"
          id="admin"
          class="input-hidden"
        />
        <label for="admin">
          <img src="//img.icons8.com/ios/100/000000/user-rights.png" alt="Admin" />
          <p class="font-weight-bold" style="padding:10px;">Admin</p>
          <p class="text-muted">For managing the whole operations.</p>
        </label>
      </div>
    </div>

    <div v-if="selectedRole != null" >
    
      <section v-if="selectedRole !== 'admin'">
        <h3>Designation Information</h3>
        <div class="form-row">
          <!-- <div class="form-group col-md-6">
            <label >Processing Centre *</label>

            <select name="processing_centre_id" class="form-control">
              <option selected>Choose...</option>
              <option :value="processingCentre.id" v-for="processingCentre in processingCentres">
                {{ processingCentre.name }}
              </option>
            </select>
          </div> -->
          <div class="form-group col-md-6">
            <label for="inputPassword4">Assigned Area *</label>
            <select  name="area_id" class="form-control">
              <option selected>Choose...</option>
              <option :value="area.id" v-for="area in areas">
                {{ area.name }}
              </option>
            </select>
          </div>
        </div>
      </section>
      <h3>Basic Information</h3>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label >Firstname *</label>
          <input name="fname" type="text" class="form-control" placeholder="Firstname" />
        </div>
        <div class="form-group col-md-6">
          <label >Lastname *</label>
          <input name="lname" type="text" class="form-control" placeholder="Lastname" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Contact No</label>
          <input name="contact_no" type="text" class="form-control" placeholder="Contact no" />
        </div>
        <div class="form-group col-md-6" v-if="selectedRole === 'driver'">
          <label>Drivers License No. *</label>
          <input name="license_no" type="text" class="form-control" placeholder="Drivers License No." />
        </div>
      </div>

      <h3>Address Information</h3>
      <div class="form-group">
        <label>Street</label>
        <input name="street" type="text" class="form-control" placeholder="1234 Main St" />
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label >City</label>
          <input  name="city" type="text" class="form-control"  />
        </div>
        <div class="form-group col-md-4">
        <label>State</label>
        <input name="state" type="text" class="form-control" />
      </div>
        <div class="form-group col-md-2">
          <label>Zip</label>
          <input name="zip" type="text" class="form-control"/>
        </div>
      </div>

      <section v-if="selectedRole !== 'normal'">
        <h3>Login Information</h3>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Email *</label>
            <input required="required" name="email" type="text" class="form-control" />
          </div>
          <div class="form-group col-md-4">
            <label>Password*</label>
            <input required="required" name="password" type="password" class="form-control" />
          </div>

          <div class="form-group col-md-4">
            <label>Confirm Password*</label>
            <input required="required" name="confirm_password" type="password" class="form-control" />
          </div>
        </div>
      </section>
  
    </div>
  </div>
</template>

    <script>
export default {
  props: ['areas','processingCentres'],
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

    <style scoped>
form {
  margin-bottom: 150px;
}
.input-hidden {
  position: absolute;
  left: -9999px;
}

input[type="radio"]:checked + label > img {
  border: 1px solid #fff;
  box-shadow: 0 0 3px 3px #090;
}

/* Stuff after this is only to make things more pretty */
input[type="radio"] + label > img {
  width: auto;
  height: auto;
  transition: 500ms all;
}

.role-selection img {
  cursor: pointer;
}
</style>
