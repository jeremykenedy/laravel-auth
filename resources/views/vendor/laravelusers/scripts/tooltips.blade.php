<script type="text/javascript">
    $(function () {
        var is_touch_device = 'ontouchstart' in document.documentElement;
        if (!is_touch_device) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
</script>
