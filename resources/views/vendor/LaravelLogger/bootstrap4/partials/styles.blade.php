

@if(config('LaravelLogger.enableBootstrapCssCDN'))
    <link rel="stylesheet" type="text/css" href="{{config('LaravelLogger.bootstrapCssCDN')}}">
@endif

@if(config('LaravelLogger.loggerDatatables'))
    <link rel="stylesheet" type="text/css" href="{{config('LaravelLogger.loggerDatatablesCSScdn')}}">
@endif

@if(config('LaravelLogger.enableFontAwesomeCDN'))
    <link rel="stylesheet" type="text/css" href="{{config('LaravelLogger.fontAwesomeCDN')}}">
@endif

<style type="text/css" media="screen">
    .clickable-row:hover {
      cursor: pointer;
    }
    .table-responsive {
        border: none;
    }

    div.activity-table table > tbody > tr > td {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .list-group {
        margin-bottom: 0;
    }
    .dropdown-menu > li button {
        padding: 3px 20px;
        background: transparent;
        border: none;
        outline: none;
        width: 100%;
        text-align: left;
        white-space: nowrap;
    }
    .dropdown-menu > li button:hover {
        background: rgba(0,0,0,.04);
    }
    .pagination {
        justify-content: center;
        margin: 1em auto;
    }

    /* Visivility Classes */
    .pull-right {
      float: right !important;
    }
    .pull-left {
      float: left !important;
    }
    .hide {
      display: none !important;
    }
    .show {
      display: block !important;
    }
    .invisible {
      visibility: hidden;
    }
    .text-hide {
      font: 0/0 a;
      color: transparent;
      text-shadow: none;
      background-color: transparent;
      border: 0;
    }
    .hidden {
      display: none !important;
    }
    .affix {
      position: fixed;
    }
    @-ms-viewport {
      width: device-width;
    }
    .visible-xs,
    .visible-sm,
    .visible-md,
    .visible-lg {
      display: none !important;
    }
    .visible-xs-block,
    .visible-xs-inline,
    .visible-xs-inline-block,
    .visible-sm-block,
    .visible-sm-inline,
    .visible-sm-inline-block,
    .visible-md-block,
    .visible-md-inline,
    .visible-md-inline-block,
    .visible-lg-block,
    .visible-lg-inline,
    .visible-lg-inline-block {
      display: none !important;
    }
    @media (max-width: 767px) {
      .visible-xs {
        display: block !important;
      }
      table.visible-xs {
        display: table !important;
      }
      tr.visible-xs {
        display: table-row !important;
      }
      th.visible-xs,
      td.visible-xs {
        display: table-cell !important;
      }
    }
    @media (max-width: 767px) {
      .visible-xs-block {
        display: block !important;
      }
    }
    @media (max-width: 767px) {
      .visible-xs-inline {
        display: inline !important;
      }
    }
    @media (max-width: 767px) {
      .visible-xs-inline-block {
        display: inline-block !important;
      }
    }
    @media (min-width: 768px) and (max-width: 991px) {
      .visible-sm {
        display: block !important;
      }
      table.visible-sm {
        display: table !important;
      }
      tr.visible-sm {
        display: table-row !important;
      }
      th.visible-sm,
      td.visible-sm {
        display: table-cell !important;
      }
    }
    @media (min-width: 768px) and (max-width: 991px) {
      .visible-sm-block {
        display: block !important;
      }
    }
    @media (min-width: 768px) and (max-width: 991px) {
      .visible-sm-inline {
        display: inline !important;
      }
    }
    @media (min-width: 768px) and (max-width: 991px) {
      .visible-sm-inline-block {
        display: inline-block !important;
      }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
      .visible-md {
        display: block !important;
      }
      table.visible-md {
        display: table !important;
      }
      tr.visible-md {
        display: table-row !important;
      }
      th.visible-md,
      td.visible-md {
        display: table-cell !important;
      }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
      .visible-md-block {
        display: block !important;
      }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
      .visible-md-inline {
        display: inline !important;
      }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
      .visible-md-inline-block {
        display: inline-block !important;
      }
    }
    @media (min-width: 1200px) {
      .visible-lg {
        display: block !important;
      }
      table.visible-lg {
        display: table !important;
      }
      tr.visible-lg {
        display: table-row !important;
      }
      th.visible-lg,
      td.visible-lg {
        display: table-cell !important;
      }
    }
    @media (min-width: 1200px) {
      .visible-lg-block {
        display: block !important;
      }
    }
    @media (min-width: 1200px) {
      .visible-lg-inline {
        display: inline !important;
      }
    }
    @media (min-width: 1200px) {
      .visible-lg-inline-block {
        display: inline-block !important;
      }
    }
    @media (max-width: 767px) {
      .hidden-xs {
        display: none !important;
      }
    }
    @media (min-width: 768px) and (max-width: 991px) {
      .hidden-sm {
        display: none !important;
      }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
      .hidden-md {
        display: none !important;
      }
    }
    @media (min-width: 1200px) {
      .hidden-lg {
        display: none !important;
      }
    }
    .visible-print {
      display: none !important;
    }
    @media print {
      .visible-print {
        display: block !important;
      }
      table.visible-print {
        display: table !important;
      }
      tr.visible-print {
        display: table-row !important;
      }
      th.visible-print,
      td.visible-print {
        display: table-cell !important;
      }
    }
    .visible-print-block {
      display: none !important;
    }
    @media print {
      .visible-print-block {
        display: block !important;
      }
    }
    .visible-print-inline {
      display: none !important;
    }
    @media print {
      .visible-print-inline {
        display: inline !important;
      }
    }
    .visible-print-inline-block {
      display: none !important;
    }
    @media print {
      .visible-print-inline-block {
        display: inline-block !important;
      }
    }
    @media print {
      .hidden-print {
        display: none !important;
      }
    }

</style>
