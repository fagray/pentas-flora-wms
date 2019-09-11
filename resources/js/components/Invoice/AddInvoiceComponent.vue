<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-4">
    <label for="my-input">C/N # *:</label>
    <input required placeholder="Consignment Note #" class="form-control" type="text" name="inv_no">
     <label for="my-input">Due Date *:</label>
    <input required class="form-control" type="date" name="due_date">
    <label for="my-input">Ref No./s *:</label>
    <textarea required placeholder="Your reference #'s here'" class="form-control" name="ref_no"></textarea>
      
      
      </div>
      <div class="offset-2 form-group col-md-4">
        <p class="title-header">Issued to:</p>
        <p>{{ customer.display_name }}</p>
        <p
          class="text-muted"
        >{{ customer.street }} {{ customer.city }} {{ customer.state }}</p>
        <p style="bottom:20px;position:relative;" class="text-muted">{{ customer.country }}</p>
        <p
          style="bottom:20px;position:relative;"
          class="text-muted"
        >{{ customer.contact_no }}</p>
        <p style="bottom:20px;position:relative;" class="text-muted">{{ customer.email }}</p>
      </div>
    </div>
    
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>Waste Item</th>
          <th>Unit Price</th>
          <th width="20%">Vol/Qty</th>
          <th>Unit</th>
          <td width="10%">Cost</td>
        </tr>
      </thead>
      <tbody>
        <tr tracked-by="$index" :key="wasteItem.id" v-for="(wasteItem,index) in job.wastes">
          <td>
            <strong>({{ wasteItem.code }})</strong>
            <i>{{ wasteItem.name }}</i>
          </td>
          <td>{{ wasteItem.pivot.unit_price }}</td>
          <td>{{ wasteItem.pivot.volume }}</td>
          <td>{{ wasteItem.unit.name }}</td>
          <td>{{ wasteItem.pivot.unit_price * wasteItem.pivot.volume }}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>Total Cost:</td>
          <td colspan="2">
            <strong>
              <money-format
                :value="totalCost"
                :locale="'en'"
                :currency-code="'MYR'"
                :subunit-value="true"
                :hide-subunits="true"
              ></money-format>
            </strong>
          </td>
        </tr>
      </tbody>
    </table>
      <input type="hidden" name="invoice_items" :value="JSON.stringify(invoiceWasteItems)" />
      <input type="hidden" name="customer_id" :value="newInvoice.customer.id" />
      <input type="hidden" name="job_id" :value="job.id" />
      <input type="hidden" name="total_amount" :value="totalCost" />
    <br />
    <br />
    <div class="form-group">
      <label for="my-textarea">Notes:</label>
      <br />

      <i>{{ job.notes }}</i>
    </div>
  </div>
</template>

<script>
import VueSimpleSuggest from "vue-simple-suggest";
import "vue-simple-suggest/dist/styles.css"; // Using a css-loader

export default {
  components: {
    VueSimpleSuggest
  },
  props: ["job","customer"],
  mounted() {
    console.log("Component mounted.");
    this.invoiceWasteItems = this.job.wastes
    this.newInvoice.customer = this.customer
    this.newInvoice.notes = this.job.notes
  },
  data() {
    return {
      thereIsWorkshopSelected: false,
      newInvoice: {
        customer: {
          id: null,
          type: null
        },
        notes: null,
        job_id: null
      },
      invoiceWasteItems: [
        {
          waste_name: null,
          waste_code: null,
          waste_id: null,
          price: "0.00",
          volume: 0,
          unit_name: null,
          unit_id: null
        }
      ]    };
  },
  computed: {
    totalCost() {
      let total = 0;
      this.job.wastes.forEach(wasteItem => {
        total += wasteItem.pivot.unit_price * wasteItem.pivot.volume;
      });
      return total;
    }
  },
  methods: {
   
  }
};
</script>

<style scoped>
form {
  margin-bottom: 200px;
}
</style>

