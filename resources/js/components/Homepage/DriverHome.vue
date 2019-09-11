<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div v-if="!isLoading && currentJob != null">
            <p class="text-success">Ongoing Job To:</p>
          <div class="row">
            <div class="col-md-2">
              <i style="margin-top:50px;" class="fa fa-truck fa-3x"></i>
            </div>
            <div class="col-md-6">
              
              <div style="padding:20px;">
                <h3>
                  <strong>{{ currentJob.costcenter.display_name }}</strong>
                </h3>
                <p>
                  Address:
                  <br />
                  {{ currentJob.costcenter.street }},
                  {{ currentJob.costcenter.state }}
                  <br />
                  {{ currentJob.costcenter.city }},
                  {{ currentJob.costcenter.country }} {{ currentJob.costcenter.zip }}
                </p>
              </div>
            </div>
            <div class="col-md-3">
                <a 
                :href="'/jobs/' +currentJob.id +'/collection/record'"
                @click="recordCollection(currentJob.id)" class="btn btn-primary">Record Collection</a>
            </div>
          </div>
        </div>

        <h2>My Jobs</h2>

        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a
              class="nav-item nav-link active"
              id="nav-invoices-tab"
              data-toggle="tab"
              href="#nav-invoices"
              role="tab"
              aria-controls="nav-invoices"
              aria-selected="true"
            >Upcoming</a>
            <a
              class="nav-item nav-link"
              id="nav-item-2-tab"
              data-toggle="tab"
              href="#nav-payments-made"
              role="tab"
              aria-controls="nav-profile"
              aria-selected="false"
            >Previous Jobs</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div
            class="tab-pane fade show active"
            id="nav-invoices"
            role="tabpanel"
            aria-labelledby="nav-invoices-tab"
          >
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Job #</th>
                  <th>Customer</th>
                  <th>Collection Date</th>
                  <th>Vehicle</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr :key="job.id" v-for="job in upComingJobs">
                  <td>{{ job.id }}</td>
                  <td>{{ job.costcenter.display_name }}</td>
                  <td>{{ job.collection_date }}</td>
                  <td>{{ job.vehicle.name }}</td>
                  <td>
                    <a v-if="job.collection_date.substring(0,10) == dateToday" class="btn btn-primary btn-sm" :href="'/jobs/' +job.id +'/collection/record'">Record Collection</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div
            class="tab-pane fade show"
            id="nav-payments-made"
            role="tabpanel"
            aria-labelledby="nav-payments-made-tab"
          >
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Job #</th>
                  <th>Customer</th>
                  <th>Collection Date</th>
                  <th>Vehicle</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr :key="job.id" v-for="job in previousJobs">
                  <td>{{ job.id }}</td>
                  <td>{{ job.costcenter.display_name }}</td>
                  <td>{{ job.collection_date }}</td>
                  <td>{{ job.vehicle.name }}</td>
                  <td> {{ job.status }} </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment'
export default {
  props: ["driver"],
  mounted() {
    console.log("Component mounted.");
    this.fetchJobs();
  },
  data() {
    return {
      upComingJobs: [],
      previousJobs: [],
      currentJob: {},
      isLoading: true,
      dateToday: moment().format('YYYY-MM-DD')
    };
  },
  methods: {
    fetchJobs() {
      this.isLoading = true;
      axios
        .get("/api/v1/employees/" + this.driver.id + "/jobs")
        .then(response => {
          console.log(response);
          this.upComingJobs = response.data.upcoming_jobs;
          this.previousJobs = response.data.previous_jobs;
          this.currentJob = response.data.current_job;
          this.isLoading = false;
        })
        .catch(function(error) {
          this.isLoading = false;
          console.log(error);
        });
    },
    
  }
};
</script>
