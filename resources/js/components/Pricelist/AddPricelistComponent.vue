<template>
  <div>
    <div class="form-row">
        <input type="hidden" name="pricelist_items" :value="JSON.stringify(pricelistItems)">
      <div class="form-group col-md-6">
        <label>Name *</label>
        <input
          required="required"
          name="name"
          type="text"
          class="form-control"
          placeholder="Pricelist name"
        />
      </div>
      <div class="form-group col-md-6">
        <label>Description</label>
        <textarea
          placeholder="Some description here..."
          id="my-textarea"
          class="form-control"
          name="description"
          rows="3"
        ></textarea>
      </div>
    </div>
    <p class="font-weight-bold">Define Waste Pricing:</p>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Waste Item</th>
          <th>Unit</th>
          <th>Price / Unit</th>
          <th width="5%">Remove</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(pricelistItem,index) in pricelistItems" :key="pricelistItem.id">
          <td>
             <select v-model="pricelistItem.waste" @change="populateRow(index)" required="required" class="form-control">
              <option :value="waste" v-for="waste in wastes" :key="waste.id" >{{ waste.name }}</option>
            </select>
          </td>
          <td>
            {{ pricelistItem.unit_name + '(' + pricelistItem.unit_symbol + ')' }}
          </td>
          <td>
            <input
              class="form-control"
              style="width:100%;"
              type="number"
              v-model="pricelistItem.unit_price"
            />
          </td>
          <td>
            <button @click.prevent="deleteRow(index)" class="btn btn-danger btn-sm">
              <i class="fa fa-times"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <a @click="addRow()" href="#" class="btn btn-primary btn-sm">Add Item</a>
  </div>
</template>

    <script>

export default {
  
  props: ["units", "wastes"],
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      pricelistItems: [
        {
          waste_id: null,
          unit_price: null,
          unit_id: null,
          unit_name: null,
          unit_symbol: null
        }
      ],
      
    };
  },
  methods: {
      populateRow (index) {
        this.pricelistItems[index].unit_price = this.pricelistItems[index].waste.unit_price
        this.pricelistItems[index].unit_id = this.pricelistItems[index].waste.unit_id
        this.pricelistItems[index].unit_name = this.pricelistItems[index].waste.unit.name
        this.pricelistItems[index].unit_symbol = this.pricelistItems[index].waste.unit.symbol
        this.pricelistItems[index].waste_id = this.pricelistItems[index].waste.id
      },
    addRow() {
      this.pricelistItems.push({
        waste_id: null,
        price: 0.0
      });
    },
    deleteRow(index) {
      this.pricelistItems.splice(index, 1);
    }
  }
};
</script>
