export default {
  table: {
    tableWrapper: '',
    tableClass: 'table table-sm table-hover table-striped',
    loadingClass: 'loading',
    ascendingIcon: 'fa fa-chevron-up',
    descendingIcon: 'fa fa-chevron-down',
    ascendingClass: 'sorted-asc',
    descendingClass: 'sorted-desc',
    sortableIcon: 'fa fa-sort',
    detailRowClass: 'vuetable-detail-row',
    handleIcon: 'fa fa-bars text-secondary',
    renderIcon(classes, options) {
      return `<i class="${classes.join(' ')}"></span>`
    }
    },
    pagination: {
    wrapperClass: 'pagination float-right',
    activeClass: 'active',
    disabledClass: 'disabled',
    pageClass: 'page-link',
    linkClass: 'page-link',
    paginationClass: 'pagination',
    paginationInfoClass: 'float-left',
    dropdownClass: 'form-control',
    icons: {
      first: 'fa fa-chevron-left',
      prev: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      last: 'fa fa-chevron-right',
    }
  }
  
}