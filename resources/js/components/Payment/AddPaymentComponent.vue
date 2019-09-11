<template>
  <div>
    <!-- Modal -->
    <div
      class="modal"
      id="addPaymentModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addPaymentModal"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addPaymentModal">Add Payment For <strong> JOB# {{ job.id }}  </strong>
            | Balance for this C/N: {{ invoice.balance_amount }}
             </h5><br/><br/>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-row">
              <div class="form-group col-md-4">
                <label>Payment Date:</label>
                <input
                  v-model="newPayment.payment_date"
                  type="date"
                  class="form-control"
                  placeholder
                />
              </div>
              <div class="form-group col-md-6">
                <label>Amount</label>
                <input
                  v-model="newPayment.amount_paid"
                  type="number"
                  class="form-control"
                  placeholder="Amount to paid"
                />
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-4">
                <label>Payment Mode</label>
                <select class="form-control" name="mode" v-model="newPayment.mode">
                    <option value="Cash">Cash</option>
                    <option value="Bank">Bank</option>
                    <option value="Cheque">Cheque</option>
                </select>
              </div>
              <div v-if="newPayment.mode === 'Bank'" class="form-group col-md-4">
                <label>Bank Name</label>
                <input
                  v-model="newPayment.bank_name"
                  type="text"
                  class="form-control"
                  placeholder="Bank name"
                />
              </div>
              <div v-if="newPayment.mode === 'Bank'" class="form-group col-md-4">
                <label>Deposit Slip #</label>
                <input
                  v-model="newPayment.deposit_slip_no"
                  type="text"
                  class="form-control"
                  placeholder="Deposit slip #"
                />
              </div>
              <div v-if="newPayment.mode === 'Cheque'" class="form-group col-md-4">
                <label>Cheque No.</label>
                <input
                  v-model="newPayment.cheque_no"
                  type="text"
                  class="form-control"
                  placeholder="Cheque No."
                />
              </div>
               
              </div>
              <div class="form-group">
                <label>Notes</label>
                <textarea placeholder="Some notes here" class="form-control" v-model="newPayment.notes" cols="30" rows="10"></textarea>
              </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button @click="addPayment()" type="button" class="btn btn-primary" v-text="isFormSubmitted ? 'Processing...' : 'Submit'"></button>
          </div>
        </div>
      </div>
      </div>
  </div>
</template>

    <script>
export default {
  props: ["invoice","job"],
  mounted() {
    console.log("Component mounted.");
    this.newPayment.payment_date = new Date().toISOString().slice(0, 10)
    this.newPayment.amount_paid = this.invoice.balance_amount
  },
  data() {
    return {
      newPayment: {
        payment_date: "",
        amount_paid: null,
        invoice_id: null,
        bank_name: null,
        cheque_no: null,
        deposit_slip_no: null,
        mode: 'Cash'
      },
      isLoading: false,
      isFormSubmitted: false
    };
  },
  methods: {
   
    addPayment() {
        this.isFormSubmitted = true
        axios
        .post('/api/v1/invoices/' + this.invoice.id + '/payments',this.newPayment)
        .then(response => {
            this.isLoading = false
            console.log(response);
            this.isFormSubmitted = false
            window.location.href = '/jobs/' + this.invoice.job_id
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
