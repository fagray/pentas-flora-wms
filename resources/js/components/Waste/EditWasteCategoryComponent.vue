<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label>Name *</label>
        <input
          required="required"
          type="text"
          class="form-control"
          placeholder="Category name"
          v-model="newCategory.name"
        />
        <input type="hidden" :value="newCategory.name" name="name">
        <input type="hidden" :value="JSON.stringify(newSubCategories)" name="sub_categories">
      </div>
    </div>
    <p>Sub Categories:</p>
      <ul style="list-style:none;">
        <li v-for="(newSubCategory, index) in newSubCategories">
            <div class="row">
              <div class="col-md-4">
                <input class="form-control" type="text" v-model="newSubCategory.name" >
              </div>
                <div class="col-md-4">
                    <a class="btn btn-default btn-sm" href="#" @click="deleteRow(index)">Delete</a>
                </div>
            </div>
        </li>
      </ul>
      <a @click="addRow()" href="#" class="btn btn-primary btn-sm">Add Sub Category</a>
     
  </div>
</template>

    <script>
export default {
    props: ["category","subCategories"],
  mounted() {
    console.log("Component mounted.")
    this.newCategory = this.category
    this.newSubCategories = this.category.sub_categories
  },
  data() {
    return {
      newCategory: [{
        name: null
      }],
      newSubCategories: null
    };
  },
  methods: {
    addRow(index) {
      this.newSubCategories.push({
        name: ""
      });
    },
    deleteRow(index) {
      this.newSubCategories.splice(index, 1);
    }
  }
};
</script>
