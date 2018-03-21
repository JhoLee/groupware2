<div id="paging-ui-personal_summary"></div>
<table id="table-personal_summary" class="table transaction-table"
       data-paging-container="#paging-ui-personal_summary">
    <thead>
    <tr>
        <th type="text">이름</th>
        <th type="text">잔액</th>
        <th type="date">변경</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php if ($rows["balance"] >= 20000) { ?>
            <td class="success"><?= $rows["name"] ?></td>
            <td class="success"><?= kmoney($rows["balance"]) ?></td>
            <td class="success"><?= compute_date($rows["processed_date"]) ?></td>
        <?php } else if ($rows["balance"] > 12345) { ?>
            <td class="active"><?= $rows["name"] ?></td>
            <td class="active"><?= kmoney($rows["balance"]) ?></td>
            <td class="active"><?= compute_date($rows["processed_date"]) ?></td>
        <?php } else if ($rows["balance"] > 7000) { ?>
            <td class="warning"><?= $rows["name"] ?></td>
            <td class="warning"><?= kmoney($rows["balance"]) ?></td>
            <td class="warning"><?= compute_date($rows["processed_date"]) ?></td>
        <?php } else { ?>
            <td class="danger"><?= $rows["name"] ?></td>
            <td class="danger"><?= kmoney($rows["balance"]) ?></td>
            <td class="danger"><?= compute_date($rows["processed_date"]) ?></td>
        <?php } ?>
    </tr>
    <tr>
        <?php if ($teamData->balance >= 222222) { ?>
            <td class="success">계좌 잔액</td>
            <td class="success"><?= kmoney($teamData->balance) ?></td>
            <td class="success"><?= compute_date($teamData->processed_date) ?></td>
        <?php } else if ($teamData->balance >= 123450) { ?>
            <td class="active">계좌 잔액</td>
            <td class="active"><?= kmoney($teamData->balance) ?></td>
            <td class="active"><?= compute_date($teamData->processed_date) ?></td>
        <?php } else if ($teamData->balance >= 60000) { ?>
            <td class="warning">계좌 잔액</td>
            <td class="warning"><?= kmoney($teamData->balance) ?></td>
            <td class="warning"><?= compute_date($teamData->processed_date) ?></td>
        <?php } else { ?>
            <td class="danger"><?= $teamData->name ?></td>
            <td class="danger"><?= kmoney($teamData->balance) ?></td>
            <td class="danger"><?= compute_date($teamData->processed_date) ?></td>
        <?php } ?>
    </tr>
    </tbody>
</table>