<template>
  <div>
    <h5>Choose the employee's role:</h5>
    <div class="row role-selection" style="padding:20px;">
      <div class="col-md-4">
        <input
          v-model="newEmployee.role"
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
          v-model="newEmployee.role"
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
          v-model="newEmployee.role"
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

    <div v-if="newEmployee.role != null" >
    
      <section v-if="newEmployee.role !== 'admin'">
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
            <select  name="area_id" class="form-control" v-model="newEmployee.area_id">
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
          <input v-model="newEmployee.fname" name="fname" type="text" class="form-control" placeholder="Firstname" />
        </div>
        <div class="form-group col-md-6">
          <label >Lastname *</label>
          <input v-model="newEmployee.lname" name="lname" type="text" class="form-control" placeholder="Lastname" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Contact No</label>
          <input v-model="newEmployee.contact_no" name="contact_no" type="text" class="form-control" placeholder="Contact no" />
        </div>
        <div class="form-group col-md-6" v-if="newEmployee.role === 'driver'">
          <label>Drivers License No. *</label>
          <input v-model="newEmployee.license_no" name="license_no" type="text" class="form-control" placeholder="Drivers License No." />
        </div>
      </div>

      <h3>Address Information</h3>
      <div class="form-group">
        <label>Street</label>
        <input v-model="newEmployee.street" name="street" type="text" class="form-control" placeholder="1234 Main St" />
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label >City</label>
          <input v-model="newEmployee.city"  name="city" type="text" class="form-control"  />
        </div>
        <div class="form-group col-md-4">
        <label>State</label>
        <input v-model="newEmployee.state" name="state" type="text" class="form-control" />
      </div>
        <div class="form-group col-md-2">
          <label>Zip</label>
          <input v-model="newEmployee.zip" name="zip" type="text" class="form-control"/>
        </div>
      </div>
    </div>
  </div>
</template>

    <script>
export default {
  props: ['areas','employee'],
  mounted() {
    console.log("Component mounted.");
    this.newEmployee = this.employee
  },
  data() {
    return {
      newEmployee: null
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
