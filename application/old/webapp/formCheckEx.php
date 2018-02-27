<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript">

            function check(form) {
                if(!form.name.value) {
                    alert("이름을 입력하세요.");
                    exit;

                } else if(!form.pwd.value) {
                    alert("암호를 입력하세요.");
                    exit;
                }
                
                
                form.submit();

                
            }

        </script>
    </head>

    <body>
        <form name="myform">
            <input type=text name="name">
            <input type=button value="전송" onClick="javascript:check(myform)">

        </form>
    </body>
</html>