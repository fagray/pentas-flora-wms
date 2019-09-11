<template>
  <div>
    <!-- Modal -->
    <div
      class="modal"
      id="assignJobModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="assignJobModal"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="assignJobModal">Complete Job Order Assignment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label>Date of Collection:</label>
                <input
                  v-model="newAssignment.collection_date"
                  name="collection_date"
                  type="date"
                  class="form-control col-md-6"
                  placeholder
                />
                <button
                    @click="findAvailableDrivers()"
                  :disabled="newAssignment.collection_date == '' && isLoading"
                  style="margin-top:15px;"
                  class="btn btn-primary btn-sm"
                  v-text="!isLoading ? 'Find Available Drivers' : 'Finding Available Drivers...'"
                ></button>
              </div>
              <div>
                <p v-if="availableDrivers.length != 0"><strong> {{ availableDrivers.length }}  </strong> available drivers found!</p>

              </div>
              <p class="font-weight-bold">Select Driver:</p>
              <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th>Select</th>
                    <th>Name</th>
                    <th>License #</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="driver in availableDrivers" :key="driver.id">
                    <td>
                      <input :value="driver.id" id="drivers" name="drivers" v-model="newAssignment.employee_id" type="radio" />
                    </td>
                    <td>{{ driver.name }} </td>
                    <td>{{ driver.license_no }} </td>
                  </tr>
                </tbody>
              </table>
              <p class="font-weight-bold">Select Vehicle:</p>
              <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th>Select</th>
                    <th>Plate #</th>
                    <th>Name</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="vehicle in vehicles" :key="vehicle.id">
                    <td>
                      <input :value="vehicle.id" id="vehicles" name="vehicles" type="radio" v-model="newAssignment.vehicle_id" />
                    </td>
                    <td>{{ vehicle.plate_no }} </td>
                    <td>{{ vehicle.name }} </td>
                  </tr>
                </tbody>
              </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button @click="completeAssignment()" type="button" class="btn btn-primary" v-text="isFormSubmitted ? 'Processing...' : 'Submit'"></button>
          </div>
        </div>
      </div>
      </div>
  </div>
</template>

    <script>
export default {
  props: ["job","vehicles"],
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      newAssignment: {
        collection_date: "",
        employee_id: null,
        vehicle_id: null
      },
      isLoading: false,
      isFormSubmitted: false,
      availableDrivers: [],
    };
  },
  methods: {
   
    findAvailableDrivers() {
      this.isLoading = true
      axios
        .get('/api/v1/jobs/find-available-drivers', {
            params: {
                collection_date: this.newAssignment.collection_date
            }
        })
        .then(response => {
            this.isLoading = false
          console.log(response);
          this.availableDrivers = response.data
        })
        .catch(function(error) {
            this.isLoading = false
          console.log(error);
        });
    },
    completeAssignment() {
        this.isFormSubmitted = true
        axios
        .post('/api/v1/jobs/' + this.job.id + '/complete-assignment',this.newAssignment)
        .then(response => {
            this.isLoading = false
            console.log(response);
            this.isFormSubmitted = false
            window.location.href = '/jobs/' + this.job.id
        })
        .catch(function(error) {
            this.isFormSubmitted = false
            this.isLoading = false
            console.log(error);
        });
    }
  }
};
</script>
