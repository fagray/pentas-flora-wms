<template>
  <div>
    <div
      id="viewPaymentsModal"
      class="modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="my-modal-title"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Payments For {{ invoice.inv_no }}</h3>
            <button class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-sm table-hovered">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Notes</th>
                </tr>
              </thead>
              <tbody>
                <tr :key="payment.id" v-for="payment in invoice.payments">
                  <td> {{ payment.payment_date }} </td>
                  <td> {{ payment.amount_paid }} ({{ payment.mode }})
                      <span v-if="payment.mode == 'Cheque'"> Cheque #: {{ payment.cheque_no }}</span>  
                       <span v-if="payment.mode == 'Bank'"> {{ payment.bank_name }}
                         | Deposit slip #: {{ payment.deposit_slip_no }}
                        </span>  

                  </td>
                  <td>
                      {{ payment.notes }}
                  </td>
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
  props: ["invoice"]
};
</script>