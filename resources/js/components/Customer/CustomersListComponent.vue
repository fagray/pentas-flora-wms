<template>
<div>
  <filter-bar></filter-bar>
  <vuetable ref="vuetable"
     api-url="/api/v1/customers"
    :fields="fields"
    @vuetable:pagination-data="onPaginationData" 
    pagination-path=""
    :css="css.table" 
    :append-params="moreParams"

  >
  <template slot="actions" slot-scope="props">
      <div class="custom-actions">
        <button class="btn btn-default btn-sm"
          @click="onAction('view-customer', props.rowData, props.rowIndex)">
          <i class="far fa-eye"></i>
        </button>
        <button class="btn btn-sm btn-default"
          @click="onAction('edit-item', props.rowData, props.rowIndex)">
          <i class="far fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-default"
          @click="onAction('delete-item', props.rowData, props.rowIndex)">
          <i class="fa fa-trash"></i>
        </button>
        <a href="#" title="Setup waste items" class="btn btn-sm btn-default"
          @click="onAction('add-waste-items', props.rowData, props.rowIndex)">
          <i class="fa fa-dumpster"></i>
        </a>
      </div>
    </template>
  </vuetable>
    <vuetable-pagination  @vuetable-pagination:change-page="onChangePage" ref="pagination" :css="css.pagination"></vuetable-pagination>
    <vuetable-pagination-info ref="paginationInfo"
      ></vuetable-pagination-info>

      
  </div>
</template>

<script>

import CssConfig from '../VuetableCssConfig'

export default {
  mounted() {
    this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
    this.$events.$on('filter-reset', e => this.onFilterReset())
  },
   data () {
    return {
      moreParams: {},
      css: CssConfig,
      fields: [
       
        {
          name: 'display_name',
          title: 'Display Name',
          sortField: 'display_name'
        },
        {
          name: 'contact_no',
          title: 'Contact No'
        },
       
        {
          name: 'email',
          title: 'Email'
        },
        {
          name: 'fax',
          title: 'Fax'
        },
        {
          name: 'type',
          title: 'Customer Type'
        },
       {
          name: '__slot:actions',   // <----
          title: 'Actions',
          titleClass: 'center aligned',
          dataClass: 'center aligned'
        }
        
      ]
    }
   },
   methods: {
     onAction (action, data, index) {
      console.log('slot) action: ' + action, data.name, index)
      switch(action) {
        case 'add-waste-items':
          window.location.href='/settings/customers/' + data.id + '/waste-items/create'
          break
        case 'view-customer':
          window.location.href='/settings/customers/' + data.id
          break
         case 'edit-item':
          window.location.href='/settings/customers/'+ data.id + '/edit'
          break
        case 'delete-item':
          if (confirm('All associated documents and transactions will also be permanently deleted, still continue ?')) {
            this.deleteCustomer(data.id)
          }
          return false
      }
    },
      onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    
    onFilterSet (filterText) {
      this.moreParams = {
            'filter': filterText
        }
        Vue.nextTick( () => this.$refs.vuetable.refresh())
    },
    onFilterReset () {
      this.moreParams = {}
        Vue.nextTick( () => this.$refs.vuetable.refresh())
    },
    deleteCustomer(id) {
      axios
        .delete("/api/v1/customers/" + id)
        .then(response => {
          alert('Customer has been deleted!')
          window.location.href= window.location.href
          console.log(response);
        })
        .catch(function(error) {
          alert('An error occured while deleting this customer!')
          console.log(error);
        }) 
    }
    
   }
    
}
</script>