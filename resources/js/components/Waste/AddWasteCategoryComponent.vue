<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label>Name *</label>
        <input
          required="required"
          name="name"
          type="text"
          class="form-control"
          placeholder="Category name"
        />
      </div>
    </div>
    <p>Sub Categories:</p>
      <ul>
        <li v-for="(input, index) in subCategories">
          <input name="sub_categories[]"  type="text" />
          <a class="btn btn-default btn-sm" href="#" @click="deleteRow(index)">Delete</a>
        </li>
      </ul>

      <a @click="addRow()" href="#" class="btn btn-primary btn-sm">Add Sub Category</a>
  </div>
</template>

    <script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      subCategories: []
    };
  },
  methods: {
    addRow() {
      this.subCategories.push({
        one: "",
        two: ""
      });
    },
    deleteRow(index) {
      this.subCategories.splice(index, 1);
    }
  }
};
</script>
