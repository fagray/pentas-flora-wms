<template>
<div>
  <filter-bar></filter-bar>
  <vuetable ref="vuetable"
     api-url="/api/v1/invoices"
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
          name: 'inv_no',
          title: 'CN #',
          sortField: 'inv_no'
        },
        {
          name: 'ref_no',
          title: 'Ref #s',
        },
       
        {
          name: 'customer.display_name',
          title: 'Customer'
        },
        {
          name: 'status',
          title: 'Status'
        },
        {
          name: 'total_amount',
          title: 'Amount'
        },
        {
          name: 'balance_amount',
          title: 'Balance'
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
      switch(action) {
        case 'view-item':
          window.location.href='/jobs/' + data.id
          break
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
    }
    
   }
    
}
</script>