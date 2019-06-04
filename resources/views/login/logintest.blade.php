<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
<table>
    <tr>
        <td>用户名：</td>
        <td><input type="text" class="username"></td>
    </tr>
    <tr>
        <td>密码：</td>
        <td><input type="password" class="password"></td>
    </tr>
    <tr>
        <td><input type="button" class="button" value="登录"></td>
        <td></td>
    </tr>
</table>
</body>
</html>
<script src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/md5.js"></script>
<script type="text/javascript">
    $('.button').click(function(){

        var name = $('.username').val();
        var pwd = $('.password').val();
        var data = {};
        data.name = name;
        data.password = pwd;
        var url = "/login";
        $.ajax({
            url : url,
            data : data,
            type : "post",
            success : function ( msg ) {
                console.log(msg);
            }
        });

    });
</script>