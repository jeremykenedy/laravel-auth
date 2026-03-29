<script type="text/javascript" src="{{config('LaravelLogger.loggerDatatablesJScdn')}}"></script>
<script type="text/javascript" src="{{config('LaravelLogger.loggerDatatablesJSVendorCdn')}}"></script>
<script type="text/javascript">
    $(function() {
        $('.data-table').dataTable({
            "order": [[0]],
            "pageLength": 100,
            "lengthMenu": [
                [10, 25, 50, 100, 500, 1000, -1],
                [10, 25, 50, 100, 500, 1000, "All"]
            ],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "dom": 'T<"clear">lfrtip',
            "sPaginationType": "full_numbers",
            'aoColumnDefs': [{
                'bSortable': false,
                'searchable': false,
                'aTargets': ['no-search'],
                'bTargets': ['no-sort']
            }]
        });
    });
</script>