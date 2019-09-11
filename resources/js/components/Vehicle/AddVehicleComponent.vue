<template>
  <div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label>Plate No *</label>
        <input
          required="required"
          name="plate_no"
          type="text"
          class="form-control"
          placeholder="Plate no"
        />
      </div>
    </div>    
    <div class="form-row">
         <div class="form-group col-md-8">
        <label>Name *</label>
        <input
        required="required"
          placeholder="Vehicle Name/model/make"
          id="input"
          class="form-control"
          name="name"
        />
      </div>
    </div>
  </div>
</template>

    <script>

export default {
  
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
    }
  },
  methods: {
      
  }
};
</script>
