<div id="paging-ui-all_details"></div>
<table id="table-all_details" class="table transaction-table"
       data-paging-container="#paging-ui-all_details" data-paging-current="999" data-paging-size="6">
    <thead>
    <tr>
        <th type="date">날짜</th>
        <th>내용</th>
        <th data-breakpoints="xs">구분</th>
        <th type="number" data-decimal-separator=".">금액</th>
        <th type="number">잔액</th>
        <th type="date" data-breakpoints="xs sm">입력일</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($rows AS $item => $row) { ?>

        <tr>
            <td><?= simplest_kdate($row->date) ?></td>
            <td><?= $row->rmks ?></td>
            <?php if ($row->type > 0) { ?>
                <td>입금</td>
                <td class="success"><?= kmoney($row->ammount) ?></td>
            <?php } else if ($row->type < 0) { ?>
                <td>출금</td>
                <td class="danger"><?= kmoney($row->ammount) ?></td>
            <?php } else { ?>
                <td>??</td>
                <td class="active"><?= kmoney($row->ammount) ?></td>
            <?php } ?>

            <?php if ($row->balance >= 20000) { ?>
                <td class="success"><?= kmoney($row->balance) ?></td>
            <?php } else if ($row->balance > 12345) { ?>
                <td class="active"><?= kmoney($row->balance) ?></td>
            <?php } else if ($row->balance > 7000) { ?>
                <td class="warning"><?= kmoney($row->balance) ?></td>
            <?php } else { ?>
                <td class="danger"><?= kmoney($row->balance) ?></td>
            <?php } ?>
            <td><?= compute_time($row->processed_date) ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>