<template>
  <div>
    <p class="title-header"><strong> APPLICATION SETTINGS  </strong></p>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Application Name</label>
        <input
          required="required"
          name="application_name"
          type="text"
          :value="settings.application_name"
          placeholder="Application Name"
          class="form-control"
        />
      </div>
      
      <div class="form-group col-md-3">
        <label>Logo</label>
        <input
          name="logo"
          type="file"
          value="Change Logo"
          class="form-control"
         
        />
      </div>
      <div class="col-md-3">
        <img style="width:100px;" height="40px;" class="img-thumbnail" :src="logoUrl" alt="">
      </div>
    </div>
    
  </div>
</template>

    <script>
    import DatePicker from 'vue2-datepicker'
    import jsonTimezones from '../../json/timezones.json'
export default {
  props: ['settings'],
  mounted() {
    console.log("Component mounted.")
    this.logoUrl = '/storage/images/' + this.settings.logo
    this.dateTime = this.settings.system_date_time
  },
  data() {
    return {
      timezones: jsonTimezones,
      dateTime: null,
      logoUrl: null
    }
  },
  methods: {
    changeDateTime (){
      
    }
  }
};
</script>
