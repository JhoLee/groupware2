<?php
/**
 * User: Jho
 * Date: 2018-03-27
 * Time: 오후 4:47
 *
 *  입금 계좌를 확인하는 페이지
 */
//
//if (isset($rows)) {
//    print_r($rows);
//    $info_head = <<<INFO_HEAD
//<table id="deposit_account_info" class="table information-table">
//    <thead>
//    <tr class="active">
//        <th>예금주</th>
//        <th>은행</th>
//        <th>계좌번호</th>
//    </tr>
//    </thead>
//    <tbody>
//INFO_HEAD;
//
//    $info_body = <<<INFO_BODY
//<tr style="font-weight:bold;">
//    <td>test5</td>
//    <td>test6</td>
//    <td>test7</td>
//</tr>
//INFO_BODY;
//
//    $info_end = <<<INFO_END
//    </tbody>
//</table>
//INFO_END;
//
//
//    $account_info = $info_head . $info_body . $info_end;
//    echo $account_info;
//}


if (!empty($rows)) {

    ?>
    <table id="deposit_account_info" class="table information-table">
    <thead>
    <tr class="active">
        <th>예금주</th>
        <th>은행</th>
        <th>계좌번호</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($rows as $row) { ?>
        <tr style="font-weight:bold;">
            <td><?= $row->예금주 ?></td>
            <td><?= $row->은행 ?></td>
            <td><?= $row->계좌번호 ?></td>
        </tr>
    <?php } ?>
    <?php
}
