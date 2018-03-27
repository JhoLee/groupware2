<div class="container contents">
    <form method="POST" action="/index.php/Transaction/insert" id="insertion_form" class="form-horizontal">

        <!--
        <div class="form-group">
            <label for="type_switch">입출금 구분: </label> <span id="type_display" style="font-weight:bold;">?</span>
            <input type="checkbox"
                   initial-value="0"
                   unchecked-value="-"
                   checked-value="+"
                   value="0" id="type_switch" class="multi-switch form-control">
        </div>
        -->

        <!--date-->

        <div class="form-group">
            <label for="date_input">날짜</label>
            <input name="date" id="date_input" class="form-control" data-role="date" data-theme="a"
                   data-inline="true"
                   value="<?php if (!empty($_date)) echo $_date ?>"
                   type="date">
        </div><!--/date-->

        <!--rmks-->
        <div class="form-group">
            <label for="rmks_input">내용</label>
            <input data-clear-btn="true" name="rmks" id="rmks_input" class="form-control"
                   placeholder="계좌 입금 / 돼지국밥"
                   value="<?php if (!empty($_rmks)) echo $_rmks ?>"
                   type="text">
        </div><!--rmks-->

        <div class="panel panel-default"></div>
        <!--Name-->
        <div class="form-group">
            <label for="name_select">이름</label>
            <select class="form-control" id="name_select" name="name">
                <option value="0" selected>...</option>
                <?php foreach ($id_array as $_id => $_name) { ?>
                    <option value="<?= $_id ?>"><?= $_name ?></option>
                <?php } ?>
            </select>
        </div><!--/Name-->


        <!--amount-->
        <div class="form-group">
            <label for="ammount_input">금액</label>
            <input name="ammount" id="ammount_input" class="form-control" placeholder="20000 / -20000"
                   value=""
                   type="text">
        </div><!--amount-->

        <!--submit-->
        <button data-role="button" id="submit_btn" class="form-control btn-block btn-success" type="submit"
                value="submit">저장
        </button><!--/submit-->

    </form>

    <script type="text/javascript">


        $('#type_switch').multiSwitch({
            functionOnChange: function ($element) {
                let value = $('#type_switch').val();
                console.log(value);
                switch (value) {
                    case '-':
                        $('#type_display').css("color", "red");
                        $('#type_display').text('출금');
                        break;
                    case '+':
                        $('#type_display').css("color", "green");
                        $('#type_display').html('입금');
                        break;
                    default:
                        $('#type_display').css("color", "rgb(51,51,51)");
                        $('#type_display').text('?');
                }
                console.log($('#type_display').color);
                console.log('hhh');
                console.log($('#type_display').text());
            }
        });
    </script>
</div>