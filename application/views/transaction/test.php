<div id="paging-ui-all_details"></div>
<div>
    <?php if (isset($info)) print_r($info); ?>
</div>
<table id="table-test" class="table test-table" data-paging="true" data-filtering="true" data-sorting="true"
       data-editing="true" data-state="true">
</table>
<script type="text/javascript">
    jQuery(function ($) {
        $('.test-table').footable({
            "columns": $.get('/application/views/transaction/columns/all_details.json'),
            "rows": $.get('/index.php/Transaction/getRowData/all/details'),
            "paging": {
                "enabled": "true",
                "limit": 3,
                "size": 9,
                "container": "#paging-ui-all_details",
                "countFormat": "{CP} / {TP}",
            },
            "position": "center"
            //todo: 페이징 및 기타 여러가지...
        });
    });
</script>