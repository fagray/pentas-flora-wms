<template>
  <div>
    <div class="job-order overflow-auto">
      <!--<div style="min-width: 600px">-->
      <header>
        <div class="row">
          <div class="col-sm-3 col-xs-3">
            <img
              v-if="settings.logo == ''"
              src="https://www.qbrobotics.com/wp-content/uploads/2018/03/sample-logo-490x200.png"
              class="img-responsive"
            />
            <img width="40" :src="'/storage/images/' + settings.logo" />
          </div>
          <div class="col-sm-9 col-xs-9 company-details">
            <div>Lot 183, JALAN 5, KOMPLEKS PERABOT OLAK LEMPIT, 42700 BANTING, SELANGOR.</div>
            <div>Tel: +603-3149 1388</div>
            <div>Fax: +603-3149 1500</div>
            <div>Email: speak2us@pentasflora.com</div>
          </div>
        </div>
      </header>
      <main>
        <div class="row">
          <div class="col-sm-3 col-xs-3 to-details">
            <p class="title-header">JOB ORDER FOR :</p>
            <div class="to-name">{{ job.costcenter.display_name }}</div>
            <div class="to-address">{{ job.costcenter.street }}</div>
            <div class="to-city">{{ job.costcenter.city }}, {{ job.costcenter.zip }}</div>
          </div>
          <div class="col-sm-9 col-xs-9 job-order-info">
            <h4 class="info-code">JOB #{{ job.id }}</h4>
            <div class="info-date">Issued : {{ job.created_at }}</div>
            <div class="info-date">Collection Date : {{ job.collection_date }}</div>
            <div class="info-agreement-type">Agreement Type: <span style="text-transform:uppercase;font-weight:bold;">{{ job.agreement_type }} </span> </div>
            <div v-if="job.employee != null" class="inf-driver"> Assigned to: {{ job.employee.fname  + ' ' + job.employee.lname }} </div>
            <div class="info-status"> {{ job.status }} </div>
            
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <table class="table table-bordered table-sm" width="100%">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Waste Item</th>
                  <th class="text-center">Vol.</th>
                  <th class="text-center">Price / Unit</th>
                  <th v-if="job.status === 'Completed'" class="text-center">Vol. Collected</th>
                  <th v-if="job.status === 'Completed'">Evidence Img</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(waste,index) in job.wastes" :key="waste.id">
                  <td class="text-center">{{ index + 1 }}</td>
                  <td class="text-center">{{ '(' + waste.code + ') ' + waste.name }}</td>
                  <td class="text-center">{{ waste.pivot.volume }}</td>
                  <td class="text-right">{{ waste.pivot.unit_price }} / {{ waste.unit.symbol }} </td>
                  <td v-if="job.status === 'Completed'" class="text-center">{{ waste.pivot.volume_collected }} {{ waste.unit.symbol }} </td>
                  <td  v-if="job.status === 'Completed'">
                    <a href="#" data-toggle="modal" data-target="#viewImageModal">View Evidence</a>
                    <modal-view-image :img="waste.pivot.evidence_img_url"> </modal-view-image>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th :colspan="job.status === 'Completed' ? 4 : 2"></th>
                  <th class="text-center">Total</th>
                  <th class="text-right">
                    <strong>
                      <money-format
                        :value="totalCost"
                        :locale="'en'"
                        :currency-code="'MYR'"
                        :subunit-value="true"
                        :hide-subunits="true"
                      ></money-format>
                    </strong>
                  </th>
                  
                </tr>
              </tfoot>
            </table>
            <br />
            <p>Notes:</p>
            {{ job.notes }}

             
          </div>
          
        </div>
        
      </main>
    </div>
  </div>
</template>

    <script>
export default {
  props: ["job", "settings"],
  mounted() {
    console.log("Component mounted.");
  },
  computed: {
    totalCost() {
      let total = 0;
      this.job.wastes.forEach(waste => {
        total += Number(waste.pivot.unit_price) * Number(waste.pivot.volume);
      });
      return total;
    }
  }
};
</script>

<style>
.job-order {
  position: relative;
  background-color: #fff;
  min-height: 680px;
  padding: 25px;
}
.job-order header {
  padding: 0px 0px 10px 0px;
  margin-bottom: 0px;
}
.job-order header img {
  max-width: 200px;
  margin-top: 0;
  margin-bottom: 0;
}
.job-order .company-details {
  text-align: right;
  margin-top: 0;
  margin-bottom: 0;
  font-size: 11px;
  color: #6e6e6e;
}
.job-order main {
  padding: 0px 0px;
  margin-bottom: 0px;
}
.job-order .to-details {
  text-align: left;
  font-size: 12px;
  color: #6e6e6e;
}
.job-order .to-name {
  font-weight: bold;
}
.job-order .to-name .to-address .to-city {
  margin-top: 0;
  margin-bottom: 0;
}
.job-order .job-order-info {
  text-align: right;
}
.job-order-info .info-code {
  font-weight: bold;
}
.job-order-info .info-status {
  font-weight: bold;
  text-transform: uppercase;
  font-family: Arial, Helvetica, sans-serif;
  color:#1dab08;
}
.job-order-info .info-code .info-date .info-driver .info-status .info-agreement-type {
  margin-top: 0;
  margin-bottom: 0;
  font-size:10px;
}

</style>

