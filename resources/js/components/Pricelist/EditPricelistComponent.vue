<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Name *</label>
        <input
          required="required"
          name="name"
          type="text"
          class="form-control"
          placeholder="Pricelist name"
          v-model="newPricelist.name"
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
          v-model="newPricelist.description"
        ></textarea>
      </div>
    </div>
    <input type="hidden" name="pricelist_items" :value="JSON.stringify(newPricelist.wastes)">
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
        <tr v-for="(pricelistItem,index) in newPricelist.wastes" :key="pricelistItem.id">
          <td>
             <select @change="populateRow(index)" v-model="pricelistItem.id"  required="required" class="form-control">
              <option :value="waste.id" v-for="waste in wastes" :key="waste.id" >{{ waste.name }}</option>
            </select>
          </td>
          <td>
            {{ pricelistItem.unit.name + '(' + pricelistItem.unit.symbol + ')' }}
          </td>
          <td>
            <input
              class="form-control"
              style="width:100%;"
              type="number"
              v-model="pricelistItem.pivot.unit_price"
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
    <a @click.prevent="addRow()" href="#" class="btn btn-primary btn-sm">Add Item</a>
  </div>
</template>

    <script>

export default {
  
  props: ["units", "wastes","pricelist"],
  mounted() {
    console.log("Component mounted.");
    this.newPricelist = this.pricelist
  },
  data() {
    return {
        newPricelist : {
            wastes: [{
                name: '',
            }]
        },
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
        console.log(index)

        let searchedWasteItem =  this.wastes.filter(wasteItem => {
            return wasteItem.id === this.newPricelist.wastes[index].id
        })
        console.log(JSON.stringify(searchedWasteItem))
        // return false
        this.newPricelist.wastes[index].pivot.unit_price = searchedWasteItem[0].unit_price
        this.newPricelist.wastes[index].unit_id = searchedWasteItem[0].unit_id
        this.newPricelist.wastes[index].unit.name = searchedWasteItem[0].unit.name
        this.newPricelist.wastes[index].unit.symbol = searchedWasteItem[0].unit.symbol
        this.newPricelist.wastes[index].pivot.waste_id = searchedWasteItem[0].id
      },
    addRow() {
      this.newPricelist.wastes.push({
        id: null,
        unit_price: 0.0,
        name: '',
        unit: {
            name: null
        },
        pivot:{
                unit_price: '0.00',
                waste_id: null,
            }
        
      });
    },
    deleteRow(index) {
      this.newPricelist.wastes.splice(index, 1);
    }
  }
};
</script>
