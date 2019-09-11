<template>
  <div class="row">
    <div class="col-md-8">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Customer *</label>
          <select
            v-model="newJob.customer"
            @change="populateWasteItemAutoSuggestions()"
            required="required"
            id="inputState"
            class="form-control"
          >
            <option value="" selected>Choose customer...</option>
            <option
              :value="customer"
              :key="customer.id"
              v-for="customer in customers"
            >{{ customer.display_name }}</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label>Workshop (optional)</label>
          <select @change="thereIsWorkshopSelected = true"  v-model="newJob.workshop" class="form-control">
            <option value selected>None</option>
            <option
              :value="workshop"
              v-for="workshop in newJob.customer.workshops"
              :key="workshop.id"
            >{{ workshop.display_name }}</option>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label>Agreement Type *</label>
              <select
          class="form-control"
          required="required"
         
          v-model="newJob.agreement_type"
        >
          <option value selected>Choose agreement type...</option>
          <option
            :value="agreementType.value"
            v-for="agreementType in agreementTypes"
            :key="agreementType.value"
          >{{ agreementType.name }}</option>
        </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p class="title-header">Company Information:</p>
          <p
            class="text-muted"
          >{{ newJob.customer.street }} {{ newJob.customer.city }} {{ newJob.customer.state }}</p>
          <p style="bottom:20px;position:relative;" class="text-muted">{{ newJob.customer.country }}</p>
          <p
            style="bottom:20px;position:relative;"
            class="text-muted"
          >{{ newJob.customer.contact_no }}</p>
          <p style="bottom:20px;position:relative;" class="text-muted">{{ newJob.customer.email }}</p>
        </div>
        <div class="col-md-6" v-if="thereIsWorkshopSelected">
          <p class="title-header">Workshop Information:</p>
          <p
            class="text-muted"
          >{{ newJob.workshop.street }} {{ newJob.workshop.city }} {{ newJob.workshop.state }}</p>
          <p
            style="bottom:20px;position:relative;"
            class="text-muted"
          >{{ newJob.workshop.country }}</p>
          <p
            style="bottom:20px;position:relative;"
            class="text-muted"
          >{{ newJob.workshop.contact_no }}</p>
          <p
            style="bottom:20px;position:relative;"
            class="text-muted"
          >{{ newJob.workshop.email }}</p>
        </div>
      </div>
      <div v-if="wastes.length == 0 && newJob.customer.id != null"> 
        <div class="alert alert-info" role="alert">
    Hey! Seems that you didn't assign waste items to this customer.
    To do that, please follow <a :href="'/settings/customers/' + newJob.customer.id + '/waste-items/create'"> this link.</a>
</div>
        <h3></h3> 
      </div>
  <div v-if="!hasError" id="waste-selection">
      <div>
        Pricelist:
        <select
          class="custom-select custom-select-sm col-md-4"
         
          v-model="newJob.pricelist"
        >
          <option value selected>Choose pricelist...</option>
          <option
            :value="pricelist"
            v-for="pricelist in pricelists"
            :key="pricelist.id"
          >{{ pricelist.name }}</option>
        </select>
      </div>
      
      <table style="margin-top:20px;" class="table table-bordered table-hover table-sm">
        <thead>
          <tr>
            <th>Waste Item </th>
            <th>Unit Price</th>
            <th width="20%">Vol/Qty</th>
            <th>Unit</th>
            <td width="10%">Cost</td>
            <th width="5%">Remove</th>
          </tr>
        </thead>
        <tbody>
          <tr
            tracked-by="$index"
            :key="wasteItem.id"
            v-for="(wasteItem,index) in choosenWasteItems"
          >
            <td>
              <vue-simple-suggest
                placeholder="Type waste code"
                ref="suggestionInput"
                v-model="wasteItem.code"
                :list="wastes"
                display-attribute="code"
                value-attribute="id"
                :styles="autoCompleteStyle"
                @select="populateRow"
                :filter-by-query="true"
              ></vue-simple-suggest>
              <hr />
              <p v-if="wasteItem.code != null">
                <strong>({{ wasteItem.waste_code }})</strong>
                <i>{{ wasteItem.waste_name }}</i>
              </p>
            </td>
            <td>{{ wasteItem.price}}</td>
            <td>
              <input
                class="form-control"
                style="width:100%;"
                type="number"
                v-model="wasteItem.volume"
              />
            </td>
            <td>{{ wasteItem.unit_name }}</td>
            <td>{{ wasteItem.price * wasteItem.volume }}</td>
            <td>
              <button @click.prevent="deleteRow(index)" class="btn btn-danger btn-sm">
                <i class="fa fa-times"></i>
              </button>
            </td>
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
      <button
        :disabled="newJob.customer.id == null "
        @click.prevent="addRow()"
        class="btn btn-primary btn-sm"
      >Add Row</button>
      <br />
      <br />
      <div class="form-group" style="margin-bottom:100px;">
        <label for="my-textarea">Notes</label>
        <textarea
          placeholder="Some notes here..."
          id="my-textarea"
          class="form-control"
          name="notes"
          rows="3"
        ></textarea>
      </div>
      </div>
    </div>

    <div class="col-md-4">
      <p class="title-header">Pricelist Information: {{ newJob.pricelist.name }}</p>
      <small>Waste Items:</small>
      <table class="table table-sm" style="font-size:10px;">
        <thead>
          <tr>
            <th width="15%">Code</th>
            <th>Name</th>
            <th width="25%">Price / Unit</th>
          </tr>
        </thead>
        <tbody>
          <tr :key="pricelistItem.id" v-for="pricelistItem in newJob.pricelist.wastes">
            <td>{{ pricelistItem.code }}</td>
            <td>{{ pricelistItem.name }}</td>
            <td>{{ pricelistItem.pivot.unit_price }}</td>
          </tr>
        </tbody>
      </table>
      <input type="hidden" name="waste_items" :value="JSON.stringify(choosenWasteItems)" />
      <input type="hidden" name="customer_id" :value="newJob.customer.id" />
      <input type="hidden" name="price_list_id" :value="newJob.pricelist.id" />
      <input type="hidden" name="type" :value="newJob.customer.type" />
      <input type="hidden" name="workshop_id" :value="newJob.workshop.id" />
      <input type="hidden" name="agreement_type" :value="newJob.agreement_type" />
    </div>
      <form-bottom-buttons  :previousUrl="'/jobs'" :disable="hasError"></form-bottom-buttons>
  </div>
</template>

<script>
import VueSimpleSuggest from "vue-simple-suggest";
import "vue-simple-suggest/dist/styles.css"; // Using a css-loader

export default {
  components: {
    VueSimpleSuggest
  },
  props: ["customers", "pricelists"],
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      thereIsWorkshopSelected: false,
      hasError: true,
      newJob: {
        customer: {
          id: null,
          type: null
        },
        pricelist_lid: null,
        pricelist: {
          name: null,
          description: null
        },
        notes: null,
        workshop: {},
        agreement_type: null
      },
      wastes: [],
      autoCompleteStyle: {
        vueSimpleSuggest: "position-relative",
        inputWrapper: "",
        defaultInput: "form-control",
        suggestions: "position-absolute list-group z-1000",
        suggestItem: "list-group-item"
      },
      choosenWasteItems: [
        {
          waste_name: null,
          waste_code: null,
          waste_id: null,
          price: "0.00",
          volume: 0,
          unit_name: null,
          unit_id: null
        }
      ],
      unitOfMeasures: ["cubic metre/s", "metric ton/s"],
      agreementTypes: [
        {
          name: 'Monthly',
          value: 'monthly'
        },
        {
          name: 'Adhoc',
          value: 'adhoc'
        },
        {
          name: 'Partial',
          value: 'partial'
        },
        {
          name: 'Pro-forma',
          value: 'pro-forma'
        }
      ]
    };
  },
  computed: {
    totalCost() {
      let total = 0;
      this.choosenWasteItems.forEach(wasteItem => {
        total += wasteItem.price * wasteItem.volume;
      });
      return total;
    }
  },
  methods: {
    populateRow(selectedWasteItem) {
      let index = this.choosenWasteItems.length - 1;
      this.choosenWasteItems[index].waste_id = selectedWasteItem.id;
      this.choosenWasteItems[index].waste_code = selectedWasteItem.code;
      this.choosenWasteItems[index].waste_name = selectedWasteItem.name;
      this.choosenWasteItems[index].unit_name = selectedWasteItem.unit.name;
      this.choosenWasteItems[index].unit_id = selectedWasteItem.unit_id;
      this.choosenWasteItems[index].volume = 1;

      // check if there was a pricelist selected
      // if there is, load the waste price from the pricelist
      let objPricelistItem = {};
      let wasteItemFoundOnPricelist = false;
      if (this.newJob.pricelist.name != null) {
        objPricelistItem = {};
        wasteItemFoundOnPricelist = false;

        this.newJob.pricelist.wastes.forEach(priceListItem => {
          if (this.choosenWasteItems[index].waste_id == priceListItem.id) {
            objPricelistItem = priceListItem;
            wasteItemFoundOnPricelist = true;
            return false;
          }
        });
      }
      if (!wasteItemFoundOnPricelist || this.newJob.pricelist.name == null) {
        this.choosenWasteItems[index].price = selectedWasteItem.unit_price;
      } else if (wasteItemFoundOnPricelist) {
        this.choosenWasteItems[index].price = objPricelistItem.pivot.unit_price;
      }
    },
    populateWasteItemAutoSuggestions() {
      if (this.newJob.customer == '') {
        alert('Please choose a customer!')
        this.hasError = true
        return false
      }
      this.wastes = [];

      if (this.wastes.length > 0) {
        this.hasError = false
      } 
      
      this.choosenWasteItems = [];
      axios
        .get("/api/v1/customers/" + this.newJob.customer.id + "/waste-items")
        .then(response => {
          this.wastes = response.data.wastes;
          if (this.wastes.length == 0) {
            alert('Seems that you did not assign waste items to this customer')
          } else if (this.wastes.length > 0) {
            this.hasError = false
          }
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    },
    addRow() {
      this.choosenWasteItems.push({
        waste_id: null,
        price: "0.00",
        volume: 0
      });
    },
    deleteRow(index) {
      this.choosenWasteItems.splice(index, 1);
    },
   
  }
};
</script>

<style scoped>
form {
  margin-bottom: 200px;
}
</style>

