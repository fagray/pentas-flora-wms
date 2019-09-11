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
          v-model="newWaste.code"
        />
      </div>
      <div class="form-group col-md-6">
        <label>Name *</label>
         <input
          name="name"
          type="text"
          class="form-control"
          placeholder="Waste name"
           v-model="newWaste.name"
        />
      </div>
      <div class="form-group col-md-6">
        <label>Unit </label>
        <select class="form-control" name="unit_id"  v-model="newWaste.unit_id">
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
           v-model="newWaste.unit_price"
        />
      </div>
     
    </div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <div class="form-group">
            <label for="my-textarea">Description</label>
            <textarea
            name="description"
             v-model="newWaste.description"
             placeholder="Some description here..." id="my-textarea" class="form-control" rows="3"></textarea>
        </div>
      </div>
    </div>

    <h3>Category</h3>
    
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Category *</label>
        
            <select required @change="findSubCategories()" class="form-control"  v-model="newWaste.category_id">
                <option value="">Choose</option>
                <option :key="category.id" :value="category.id" v-for="category in categories">
                  {{ category.name }}
                </option>
            </select>
            <input type="hidden" name="category_id" :value="newWaste.category_id">
        
      </div>
      <div class="form-group col-md-6">
        <label>Sub Category</label>
        <select required class="form-control" name="sub_category_id"  v-model="newWaste.sub_category_id">
                <option value="">Choose</option>
                <option :key="subCategory.id" :value="subCategory.id" v-for="subCategory in newWaste.category.sub_categories">
                  {{ subCategory.name }}
                </option>
            </select>
      </div>
    </div>
  </div>
</template>

    <script>
export default {
  props: ['categories','units','waste'],
  mounted() {
    console.log("Component mounted.");
    this.newWaste = this.waste
    this.findSubCategories()
  },
  data() {
    return {
      category: [],
      categoryId: null,
      newWaste: {
          name: null
      }
    }
   
  },
  methods: {
    findSubCategories () {
      var vm = this
      var category = this.categories.filter(function(val) {
          return val.id === vm.newWaste.category_id
      });
      return this.category = category[0]
    }
  }
};
</script>
