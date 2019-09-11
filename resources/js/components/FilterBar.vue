<template>
   <div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Search:</label>
    <div class="col-sm-6">
      <input v-model="filterText" type="text"  class="form-control" placeholder="Enter keywords...">
    </div>
       <div class="col-sm-4">
            <button class="btn btn-primary" @click="doFilter"> Search </button>
             <button class="btn btn-default" @click="resetFilter"> Reset </button>
       </div>
  </div>
  
</div>
  </template>

  <script>
  export default {
    data () {
      return {
        filterText: ''
      }
    },
    methods: {
      doFilter () {
      this.$events.fire('filter-set', this.filterText)
    },
    resetFilter () {
      this.filterText = ''  // clear the text in text input
      this.$events.fire('filter-reset')
    }
    }
  }
</script>