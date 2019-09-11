<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Code *</label>
         <input
          name="code"
          type="text"
          class="form-control"
          placeholder="Waste code"
        />
      </div>
      <div class="form-group col-md-6">
        <label>Name *</label>
         <input
          name="name"
          type="text"
          class="form-control"
          placeholder="Waste name"
        />
      </div>
      <div class="form-group col-md-6">
        <label>Unit </label>
        <select class="form-control" name="unit_id">
                <option value="">Choose unit</option>
                <option :value="unit.id" :key="unit.id" v-for="unit in units">
                  {{ unit.name }}
                </option>
            </select>
      </div>
      <div class="form-group col-md-6">
        <label>Unit Price </label>
        <input
          name="unit_price"
          type="number"
          class="form-control"
          placeholder="Unit price"
        />
      </div>
     
    </div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <div class="form-group">
            <label for="my-textarea">Description</label>
            <textarea placeholder="Some description here..." id="my-textarea" class="form-control" name="" rows="3"></textarea>
        </div>
      </div>
    </div>

    <h3>Category</h3>
    
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Category *</label>
        
            <select required @change="findSubCategories()" class="form-control" v-model="categoryId">
                <option value="">Choose</option>
                <option :value="category.id" v-for="category in categories">
                  {{ category.name }}
                </option>
            </select>
            <input type="hidden" name="category_id" :value="categoryId">
        
      </div>
      <div class="form-group col-md-6">
        <label>Sub Category</label>
        <select required class="form-control" name="sub_category_id">
                <option value="">Choose</option>
                <option :value="subCategory.id" v-for="subCategory in category.sub_categories">
                  {{ subCategory.name }}
                </option>
            </select>
      </div>
     
    </div>
  </div>
</template>

    <script>
export default {
  props: ['categories','units'],
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      category: [],
      categoryId: null
    }
   
  },
  methods: {
    findSubCategories () {
      var vm = this
      var category = this.categories.filter(function(val) {
          return val.id === vm.categoryId
      });
      return this.category = category[0]
    }
  }
};
</script>
