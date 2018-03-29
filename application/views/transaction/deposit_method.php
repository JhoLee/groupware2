<?php if ($permission >= 2) { ?>
<table id="table-deposit_method" class="table" data-editing="true">
    <?php } else { ?>
    <table id="table-deposit_method" class="table">
        <?php } ?>
        <thead>
        <tr class="active">
            <th class="hide">id</th>
            <th>예금주</th>
            <th>은행</th>
            <th>계좌번호</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($rows)) { ?>
        <?php foreach ($rows as $row) { ?>
            <tr style="font-weight:bold;">
                <td class="hide"><?= $row->id ?></td>
                <td><?= $row->예금주 ?></td>
                <td><?= $row->은행 ?></td>
                <td><?= $row->계좌번호 ?></td>
            </tr>
        <?php } ?>
        </tbody>
    <?php } ?>
    </table>

    <div class="modal fade" id="editor-modal" tabindex="-1" role="dialog" aria-labelledby="editor-title">
        <style scoped>
            /* provides a red astrix to denote required fields - this should be included in common stylesheet */
            .form-group.required .control-label:after {
                content: "*";
                color: red;
                margin-left: 4px;
            }
        </style>
        <div class="modal-dialog" role="document">
            <form class="modal-content form-horizontal" id="editor">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="editor-title">Add Row</h4>
                </div>
                <div class="modal-body">
                    <input type="number" id="id" name="id" class="hidden"/>
                    <div class="form-group required">
                        <label for="owner" class="col-sm-3 control-label">예금주</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="owner" name="owner" placeholder="예금주"
                                   required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="bank" class="col-sm-3 control-label">은행</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bank" name="bank" placeholder="은행">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="number" class="col-sm-3 control-label">계좌번호</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="number" name="number" placeholder="계좌번호"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        // TODO: 미완성...
        jQuery(function ($) {
            $('.hide').hide();
            let $modal = $('#editor-modal'),
                $editor = $('#editor'),
                $editorTitle = $('#editor-title'),
                ft = FooTable.init('#table-deposit_method', {
                    editing: {
                        showText: "수정",
                        hideText: "취소",
                        addText: "추가",

                        addRow: function () {
                            $modal.removeData('row');
                            $editor[0].reset();
                            $editorTitle.text('입금 계좌 추가');
                            $modal.modal('show');
                        },
                        editRow: function (row) {
                            let values = row.val();
                            $editor.find('#id').val(values.col1);
                            $editor.find('#owner').val(values.col2);
                            $editor.find('#bank').val(values.col3);
                            $editor.find('#number').val(values.col4);
                            $modal.data('row', row);
                            $editorTitle.text('입금 계좌 수정');
                            $modal.modal('show');
                        },
                        deleteRow: function (row) {
                            if (confirm('정말로 선택한 계좌 정보를 삭제할까요?')) {
                                let values = row.val();
                                $id = values.col1;
                                $.ajax({
                                    url: '/index.php/transaction/configDepositInfo',
                                    async: true,
                                    type: 'POST',
                                    data: {
                                        type: 'delete',
                                        id: $id
                                    },
                                    dataType: 'text',
                                    success: function (data) {
                                        console.log(data);
                                        location.reload();
                                    }
                                });
                            }
                        }
                    }
                }),
                uid = 10001;

            $editor.on('submit', function (e) {
                if (this.checkValidity && !this.checkValidity()) return;
                e.preventDefault();

                $.ajax({
                    url: '/index.php/transaction/configDepositInfo',
                    async: true,
                    type: 'POST',
                    data: {
                        id: $editor.find('#id').val(),
                        owner: $editor.find('#owner').val(),
                        bank: $editor.find('#bank').val(),
                        number: $editor.find('#number').val()
                    },
                    dataType: 'text',
                    success: function (data) {
                        console.log(data);
                        location.reload();
                    }
                });

                // let row = $modal.data('row'),
                //     values = {
                //         col0: $editor.find('#id').val(),
                //         col1: $editor.find('#owner').val(),
                //         col2: $editor.find('#bank').val(),
                //         col3: $editor.find('#number').val()
                //     };
                // if (!(row instanceof FooTable.Row)) {
                // values.id = uid++;

                $modal.modal('hide');
            });
        });
    </script>

