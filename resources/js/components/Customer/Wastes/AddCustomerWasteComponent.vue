<template>
  <div>
   
    
    <p>Waste Items:</p>
    <table class="table table-hovered table-striped">
        <thead>
            <th>Waste Items</th>
            <th></th>
            <th></th>
        </thead>
      <tbody>
        <tr v-for="(currentWasteItem, index) in currentWasteItems">
          <td>
            <select  name="wastes[]"  class="form-control">
              <option selected :value="currentWasteItem.id"> {{ currentWasteItem.name }} </option>
              <option :value="waste.id" :key="waste.id" v-for="waste in wasteItems"> {{ waste.name }} </option>
            </select></td>
          </td>
          <td> </td>
          <td>
            <a class="btn btn-default btn-sm" href="#" @click="deleteRow(index)">Delete</a>
          </td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" name="customer_id" :value="customer.id">
    <a @click.prevent="addRow()" href="#" class="btn btn-primary btn-sm">Add Row</a>
    <p class="mt-2" > <small> <a class="text-muted" href="/settings/customers">No thanks, I will do that later instead</a> </small></p>
  </div>
</template>

    <script>
export default {
    props: ['wasteItems','customer'],
  mounted() {
    console.log("Component mounted.");
    this.currentWasteItems = this.customer.wastes
  },
  data() {
    return {
      currentWasteItems: []
    };
  },
  methods: {
    addRow() {
      this.currentWasteItems.push({
        one: "",
        two: ""
      });
    },
    deleteRow(index) {
      this.currentWasteItems.splice(index, 1);
    }
  }
};
</script>
