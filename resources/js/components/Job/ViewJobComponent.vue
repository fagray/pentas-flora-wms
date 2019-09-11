<template>
  <div>
    <h3>
      Job Order Details:
      <div class="float-right">
        <button
          @click="generateInvoice()"
          v-if="job.status"
          class="btn btn-sm btn-primary"
        >CREATE CONSIGNMENT NOTE</button>
        
        <button
          @click="approveJob()"
          v-if="job.status === 'Completed'"
          class="btn btn-sm btn-success"
          v-text="isLoading ? 'VERIFYING...' : 'VERIFY'"
        ></button>
        <button v-if="job.status === 'Open'" data-toggle="modal" data-target="#assignJobModal" class="btn btn-sm btn-secondary">ASSIGN</button>
      </div>
    </h3>
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
        >Consignment Notes</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div
        class="tab-pane fade show active"
        id="nav-invoices"
        role="tabpanel"
        aria-labelledby="nav-invoices-tab"
      >
        <table class="table table-sm">
          <thead>
            <th>CN #</th>
            <th>Ref #</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Balance</th>
            <th></th>
          </thead>
          <tbody>
            <tr v-for="invoice in job.invoices">
              <td> {{ invoice.inv_no }} </td>
              <td> {{ invoice.ref_no }} </td>
              <td> {{ invoice.status }} </td>
              <td> {{ Number(invoice.total_amount).toFixed(2) }} </td>
              <td> {{ Number(invoice.balance_amount).toFixed(2) }} </td>
              <td>
                <button class="btn btn-sm" data-toggle="modal" 
                  data-target="#viewPaymentsModal"  @click="selectedInvoice = invoice">View Payments</button>
                <button @click="selectedInvoice = invoice" v-if="invoice.status != 'Paid'" data-toggle="modal" 
                  data-target="#addPaymentModal" class="btn btn-sm btn-secondary">
                    ADD PAYMENT
                  </button>
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
        <table class="table table-sm">
          <thead>
            <th>Payment Date</th>
            <th>C/N #</th>
            <th>Amount Paid</th>
          </thead>
          <tbody>
            <tr>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div v-if="job.status == 'Assigned'" class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
   Waiting for the driver to input the actual collection info. 
</div>
<div v-if="job.status == 'Open'" class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
   This job needs to assign collection details after paying a part of the amount on the consignment note.
</div>
<div v-if="job.status == 'Completed'" class="alert alert-dismissible alert-info">
 
   Collection procedures has been conducted! Waiting for verification.<br/><br/>
    <p style="background:#fff;">Date of Collection: {{ job.collected_at }}  <br/>
    Collected by: {{ job.employee.fname }}  {{ job.employee.lname }} </p>
</div>
    <job-order-view-form :job="job" :settings="settings"></job-order-view-form>
    <assign-job :job="job" :vehicles="vehicles"> </assign-job>
    <modal-view-payments v-if="selectedInvoice != null" :invoice="selectedInvoice">> </modal-view-payments>
    <add-payment :job="job" v-if="selectedInvoice != null" :invoice="selectedInvoice"> </add-payment>
  </div>
</template>

    <script>
export default {
  props: ["job", "settings","vehicles"],
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      subCategories: [],
      selectedInvoice: null,
      isLoading: false
    }
  },
  methods: {
    generateInvoice () {
      // if (type == 'proforma') {
        window.location.href='/billing/invoices/create?type=proforma&ref=' + this.job.id
      // }
      // if (type == 'consignment') {
      //   window.location.href='/billing/invoices/create?ref=' + this.job.id
      // }
      
    },
    approveJob () {
      this.isLoading = true
        axios
        .post('/api/v1/jobs/' + this.job.id + '/collection/verify')
        .then(response => {
            this.isLoading = false
            console.log(response);
            window.location.href = '/jobs/' + this.job.id
        })
        .catch(function(error) {
            this.isLoading = false
            console.log(error);
        });
    }
  }
};
</script>
