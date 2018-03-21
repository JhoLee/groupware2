<table id="table-all_summary" class="table transaction-table">
    <thead>
    <tr>
        <th class="active">이름</th>
        <th class="active">잔액</th>
        <th class="active">변경</th>
    </tr>
    </thead>
    <tbody>
    <tr style="font-weight:bold;">
        <?php if ($teamData->balance >= 222222) { ?>
            <td class="success">계좌 잔액</td>
            <td class="success"><?= kmoney($teamData->balance) ?></td>
            <td class="success"><?= compute_date($teamData->processed_date) ?></td>
        <?php } else if ($teamData->balance >= 123450) { ?>
            <td class="active">계좌 잔액</td>
            <td class="active"><?= kmoney($teamData->balance) ?></td>
            <td class="active"><?= compute_date($teamData->processed_date) ?></td>
        <?php } else if ($teamData->balance >= 70000) { ?>
            <td class="warning">계좌 잔액</td>
            <td class="warning"><?= kmoney($teamData->balance) ?></td>
            <td class="warning"><?= compute_date($teamData->processed_date) ?></td>
        <?php } else { ?>
            <td class="danger"><?= $teamData->name ?></td>
            <td class="danger"><?= kmoney($teamData->balance) ?></td>
            <td class="danger"><?= compute_date($teamData->processed_date) ?></td>
        <?php } ?>
    </tr>
    <!-- TODO: 팀 별로, 팀장이 '한계선'을 조정할 수 있도록 변경할 것 -->
    <?php foreach ($rows AS $item => $row) { ?>
        <tr>
            <?php if ($row->balance >= 20000) { ?>
                <td class="success"><?= $row->name ?></td>
                <td class="success"><?= kmoney($row->balance) ?></td>
                <td class="success"><?= compute_date($row->processed_date) ?></td>
            <?php } else if ($row->balance >= 12345) { ?>
                <td class="active"><?= $row->name ?></td>
                <td class="active"><?= kmoney($row->balance) ?></td>
                <td class="active"><?= compute_date($row->processed_date) ?></td>
            <?php } else if ($row->balance > 7000) { ?>
                <td class="warning"><?= $row->name ?></td>
                <td class="warning"><?= kmoney($row->balance) ?></td>
                <td class="warning"><?= compute_date($row->processed_date) ?></td>
            <?php } else { ?>
                <td class="danger"><?= $row->name ?></td>
                <td class="danger"><?= kmoney($row->balance) ?></td>
                <td class="danger"><?= compute_date($row->processed_date) ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>