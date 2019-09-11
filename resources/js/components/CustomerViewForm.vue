<template>
  <div>
    <h2>{{ customer.display_name }}</h2>
    
    <div class="row">
      <div class="col-md-4">
        <br />
        <strong>Address:</strong>
        <br />
        <p
          style="padding:10px;"
        >{{ customer.street + ' ' + customer.city + ' ' + customer.state + ' ' + customer.country + ',' + customer.zip}}</p>
        <strong>Contact Information:</strong>
        <br />
        <p style="padding:10px;">
          Email: {{ customer.email }}
          <br />
          Phone: {{ customer.email }}
          <br />
          Fax: {{ customer.fax }}
        </p>
      </div>
      <div class="col-md-8">
         
        <button @click="addWorkshop()" class="btn btn-primary float-right">New Workshop</button><br/><Br/>
          
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a
              class="nav-link active"
              id="home-tab"
              data-toggle="tab"
              href="#workshops"
              role="tab"
              aria-controls="home"
              aria-selected="true"
            >Workshops</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="#workshops"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Contact #</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="workshop in customer.workshops" :key="workshop.id">
                  <td>{{ workshop.display_name }}</td>
                  <td>{{ workshop.street + ' ' + workshop.state + ' ' + workshop.city + ' ' + workshop.zip }}</td>
                  <td>{{ workshop.contact_no }}</td>
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
export default {
  props: ["customer"],
  methods: {
      addWorkshop () {
          window.location.href = '/settings/customers/' + this.customer.id + '/workshops/create'
      }
  }
}
</script>
