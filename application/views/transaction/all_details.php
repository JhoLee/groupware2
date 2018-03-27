<div id="paging-ui-all_details"></div>
<table id="table-all_details" class="table transaction-table">
    <thead>
    <tr>
        <th type="date">날짜</th>
        <th>이름</th>
        <th data-breakpoints="xs">구분</th>
        <th data-breakpoints="xs">내용</th>
        <th type="number" data-decimal-separator=".">금액</th>
        <th type="number">잔액</th>
        <th type="date" data-breakpoints="xs sm">입력일</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($rows AS $item => $row) { ?>
        <?php if ($row->type > 0) { ?>
            <tr class="success">
                <td><?= simple_kdate($row->date) ?></td>
                <td><?= $row->name ?></td>
                <td>
                    <?php
                    switch ($row->type) {
                        case 1: ?>
                            입금
                            <?php
                            break;
                        case -1: ?>
                            출금
                            <?php break;
                        default: ?>
                            ?
                        <?php } ?>
                </td>
                <td><?= $row->rmks ?></td>
                <td><?= kmoney($row->ammount) ?></td>
                <td><?= kmoney($row->balance) ?></td>
                <td><?= compute_time($row->processed_date) ?></td>
            </tr>
        <?php } else if ($row->type < 0) { ?>
            <tr class="danger">
                <td><?= simple_kdate($row->date) ?></td>
                <td><?= $row->name ?></td>
                <td>
                    <?php
                    switch ($row->type) {
                        case 1: ?>
                            입금
                            <?php
                            break;
                        case -1: ?>
                            출금
                            <?php break;
                        default: ?>
                            ?
                        <?php }
                    ?>
                </td>
                <td><?= $row->rmks ?></td>
                <td><?= kmoney($row->ammount) ?></td>
                <td><?= kmoney($row->balance) ?></td>
                <td><?= compute_time($row->processed_date) ?></td>
            </tr>
        <?php } else { ?>
            <tr class="active">
                <td><?= simple_kdate($row->date) ?></td>
                <td><?= $row->name ?></td>
                <td>
                    <?php
                    switch ($row->type) {
                        case 1: ?>
                            입금
                            <?php
                            break;
                        case -1: ?>
                            출금
                            <?php break;
                        default: ?>
                            ?
                        <?php }
                    ?>
                </td>
                <td><?= $row->rmks ?></td>
                <td><?= kmoney($row->ammount) ?></td>
                <td><?= kmoney($row->balance) ?></td>
                <td><?= compute_time($row->processed_date) ?></td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>
<script type="text/javascript">
    $(function ($) {

        $('#table-all_details').footable({
            "editing": {
                "enabled": true,
                "showText": '<span class="fooicon fooicon-pencil" aria-hidden="true"></span> 수정'
            },
            "paging": {
                "enabled": true,
                "container": "#paging-ui-all_details",
                "countFormat": "{CP} / {TP}",
                "current": 999,
                "limit": 4,
                "size": 15
            },
            "sorting": {
                "enabled": true
            }
        });
    });
</script>