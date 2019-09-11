<template>
<div>
  <filter-bar></filter-bar>
  <vuetable ref="vuetable"
     api-url="/api/v1/pricelists"
    :fields="fields"
   @vuetable:pagination-data="onPaginationData" 
    pagination-path=""
    :css="css.table" 
    :append-params="moreParams"
    
  >
  <template slot="actions" slot-scope="props">
      <div class="custom-actions">
        <button class="btn btn-default btn-sm"
          @click="onAction('view-item', props.rowData, props.rowIndex)">
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
      </div>
    </template>
  </vuetable>
  <div>
     <vuetable-pagination-info ref="paginationInfo"
      ></vuetable-pagination-info>
    <vuetable-pagination @vuetable-pagination:change-page="onChangePage" ref="pagination" :css="css.pagination"></vuetable-pagination>
  </div>
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
          name: 'name',
          title: 'Name',
          sortField: 'name'
        },
        {
          name: 'description',
          title: 'Description'
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
      onAction(action, data, index) {
      switch(action) {
        case 'view-item':
          window.location.href='/settings/pricelists/'+ data.id
          break
        case 'edit-item':
          window.location.href='/settings/pricelists/'+ data.id + '/edit'
          break
        case 'delete-item':
          if (confirm('All of other related documents and transactions will be deleted permanently, continue?')) {
            this.deletePricelist(data.id)
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
    deletePricelist(id) {
      axios
        .delete("/api/v1/pricelists/" + id)
        .then(response => {
          alert('Pricelist has been deleted!')
          window.location.href= window.location.href
          console.log(response);
        })
        .catch(function(error) {
          alert('An error occured while deleting this pricelist!')
          console.log(error);
        }) 
    }
    
   }
    
}
</script>