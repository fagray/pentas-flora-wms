/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueEvents from 'vue-events'


Vue.use(VueEvents)



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('employees-list', require('./components/Employee/EmployeesListComponent.vue').default);
Vue.component('add-employee', require('./components/Employee/AddEmployeeComponent.vue').default);
Vue.component('edit-employee', require('./components/Employee/EditEmployeeComponent.vue').default);


Vue.component('processing-centres-list', require('./components/ProcessingCentre/ProcessingCentresListComponent.vue').default);
Vue.component('add-processing-centre', require('./components/ProcessingCentre/AddProcessingCentreComponent.vue').default);

Vue.component('general-settings', require('./components/Settings/GeneralSettings.vue').default);

Vue.component('areas', require('./components/Area/AreasListComponent.vue').default);
Vue.component('add-area', require('./components/Area/AddAreaComponent.vue').default);
Vue.component('edit-area', require('./components/Area/EditAreaComponent.vue').default);

Vue.component('invoices', require('./components/Invoice/InvoicesListComponent.vue').default);
Vue.component('add-invoice', require('./components/Invoice/AddInvoiceComponent.vue').default);
Vue.component('modal-view-payments', require('./components/Invoice/ModalViewPayments.vue').default);


Vue.component('customers', require('./components/Customer/CustomersListComponent.vue').default);
Vue.component('add-customer', require('./components/Customer/AddCustomerComponent.vue').default);
Vue.component('view-customer', require('./components/Customer/ViewCustomerComponent.vue').default);
Vue.component('add-customer-waste-items', require('./components/Customer/Wastes/AddCustomerWasteComponent.vue').default);
Vue.component('add-workshop', require('./components/Customer/Workshop/AddWorkshopComponent.vue').default);
Vue.component('edit-customer', require('./components/Customer/EditCustomerComponent.vue').default);


Vue.component('wastes', require('./components/Waste/WastesListComponent.vue').default);
Vue.component('add-waste', require('./components/Waste/AddWasteComponent.vue').default);
Vue.component('waste-categories', require('./components/Waste/WasteCategoriesListComponent.vue').default);
Vue.component('add-waste-category', require('./components/Waste/AddWasteCategoryComponent.vue').default);
Vue.component('edit-waste-category', require('./components/Waste/EditWasteCategoryComponent.vue').default);
Vue.component('edit-waste', require('./components/Waste/EditWasteComponent.vue').default);

Vue.component('jobs', require('./components/Job/JobsListComponent.vue').default);
Vue.component('add-job', require('./components/Job/AddJobComponent.vue').default);
Vue.component('view-job', require('./components/Job/ViewJobComponent.vue').default);
Vue.component('assign-job', require('./components/Job/AssignJobComponent.vue').default);

Vue.component('add-payment', require('./components/Payment/AddPaymentComponent.vue').default);
Vue.component('payments', require('./components/Payment/PaymentsListComponent.vue').default);

Vue.component('record-collection', require('./components/Job/Collection/RecordCollectionComponent.vue').default);

Vue.component('pricelists', require('./components/Pricelist/PricelistsComponent.vue').default);
Vue.component('add-pricelist', require('./components/Pricelist/AddPricelistComponent.vue').default);
Vue.component('edit-pricelist', require('./components/Pricelist/EditPricelistComponent.vue').default);


Vue.component('vehicles', require('./components/Vehicle/VehiclesListComponent.vue').default);
Vue.component('add-vehicle', require('./components/Vehicle/AddVehicleComponent.vue').default);
Vue.component('edit-vehicle', require('./components/Vehicle/EditVehicleComponent.vue').default);

//homepage
Vue.component('driver-home', require('./components/Homepage/DriverHome.vue').default);
Vue.component('admin-home', require('./components/Homepage/AdminHome.vue').default);

// Vuetable components
Vue.component('vuetable', require('vuetable-2').default)
Vue.component('vuetable-pagination', require('vuetable-2/src/components/VuetablePagination').default)
Vue.component('vuetable-pagination-info', require('vuetable-2/src/components/VuetablePaginationInfo').default)

Vue.component('filter-bar', require('./components/FilterBar.vue').default)
Vue.component('job-order-view-form', require('./components/JobOrderViewForm.vue').default)
Vue.component('customer-view-form', require('./components/CustomerViewForm.vue').default)
Vue.component('custom-actions', require('./components/CustomActions.vue').default)
Vue.component('money-format', require('vue-money-format').default)
Vue.component('form-bottom-buttons', require('./components/FormBottomButtons.vue').default)
Vue.component('modal-view-image', require('./components/ModalViewImage.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
