{{-- FYI: Datatables do not support colspan or rowspan --}}
<script type="text/javascript" src="{{ config('laravelusers.datatablesJsCDN') }}"></script>
<script type="text/javascript" src="{{ config('laravelusers.datatablesJsPresetCDN') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.data-table').dataTable({
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
