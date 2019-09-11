<template>
  <div>
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a
          class="nav-item nav-link active"
          id="nav-home-tab"
          data-toggle="tab"
          href="#nav-home"
          role="tab"
          aria-controls="nav-home"
          aria-selected="true"
        >Waste Items</a>
        <a
          class="nav-item nav-link"
          id="nav-profile-tab"
          data-toggle="tab"
          href="#nav-profile"
          role="tab"
          aria-controls="nav-profile"
          aria-selected="false"
        >Categories</a>
       
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div
        class="tab-pane fade show active"
        id="nav-home"
        role="tabpanel"
        aria-labelledby="nav-home-tab"
      >
    <filter-bar style="margin-top:10px;"></filter-bar>
    <vuetable
      ref="vuetable"
      api-url="/api/v1/wastes"
      :fields="fields"
      @vuetable:pagination-data="onPaginationData"
      pagination-path
      :css="css.table"
      :append-params="moreParams"
    >
    <template slot="actions" slot-scope="props">
      <div class="custom-actions">
        
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
    
      <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>
      <vuetable-pagination
        @vuetable-pagination:change-page="onChangePage"
        ref="pagination"
        :css="css.pagination"
      ></vuetable-pagination>

      </div>
      
      <div
        class="tab-pane fade"
        id="nav-profile"
        role="tabpanel"
        aria-labelledby="nav-profile-tab"
      >
        <waste-categories></waste-categories>
      </div>
      
    </div>
    
    </div>
</template>

<script>
import CssConfig from "../VuetableCssConfig";

export default {
  mounted() {
    this.$events.$on("filter-set", eventData => this.onFilterSet(eventData));
    this.$events.$on("filter-reset", e => this.onFilterReset());
  },
  data() {
    return {
      moreParams: {},
      css: CssConfig,
      fields: [
        {
          name: "code",
          title: "Code",
          sortField: "code"
        },
        {
          name: "name",
          title: "Name",
          sortField: "name"
        },
        {
          name: "unit.symbol",
          title: "Unit"
        },
         {
          name: "unit_price",
          title: "Price"
        },
        {
          name: "category.name",
          title: "Category"
        },
        {
          name: "sub_category.name",
          title: "Sub Category"
        },
         {
          name: '__slot:actions',   // <----
          title: 'Actions',
          titleClass: 'center aligned',
          dataClass: 'center aligned'
        }
      ]
    };
  },
  methods: {
    onAction(action, data, index) {
      switch(action) {
        case 'edit-item':
          window.location.href='/settings/wastes/'+ data.id + '/edit'
          break
        case 'delete-item':
          if (confirm('All of the associated consignment notes and other documents will also be deleted permanently, continue?')) {
            this.deleteWaste(data.id)
          }
          return false
        
      }
    },
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
      this.$refs.paginationInfo.setPaginationData(paginationData);
    },
    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },

    onFilterSet(filterText) {
      this.moreParams = {
        filter: filterText
      };
      Vue.nextTick(() => this.$refs.vuetable.refresh());
    },
    onFilterReset() {
      this.moreParams = {};
      Vue.nextTick(() => this.$refs.vuetable.refresh());
    },
    deleteWaste(id) {
      axios
        .delete("/api/v1/wastes/" + id)
        .then(response => {
          alert('Waste has been deleted!')
          window.location.href= window.location.href
          console.log(response);
        })
        .catch(function(error) {
          alert('An error occured while deleting this waste!')
          console.log(error);
        }) 
    }
  }
};
</script>