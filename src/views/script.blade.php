<table id="{{$datatable->selector()}}"></table>
<script type="text/javascript">
    (function () {
        'use strict';

        var original_settings = {
            empty_table: $.fn.DataTable.defaults.oLanguage.sEmptyTable,
            info_empty: $.fn.DataTable.defaults.oLanguage.sInfoEmpty
        };

        var options = $.extend(
            {{json_encode($datatable->data())}},
            window.dt_options || {}
        );
        var datatable = $('#{{$datatable->selector()}}').dataTable(
            options
        ).api();

        $.get('{{$datatable->route()}}', function (result) {
            datatable.clear().draw();
            datatable.settings()[0].oLanguage.sEmptyTable = original_settings.empty_table;
            datatable.settings()[0].oLanguage.sInfoEmpty = original_settings.info_empty;
            datatable.rows.add(result.data);
            datatable.draw();
        }, 'json');
        window.dt_options = null;
    }());
</script>
