<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="">
        姓名:<input type="text" name="username" id="username">
        <br><br>
        密码:<input type="password" name="password" id="password">
        <br><br>
        <input type="button" id="btn" value="登录">
        <a href="http://www.api2.com/registerList">注册</a>
    </form>


</body>
</html>
<script src="/js/jquery-1.9.1.min.js"></script>
<script>
    $(function(){
        $("#btn").click(function(){
            var name = $("#username").val();
            var password = $("#password").val();

            $.ajax({
                url:"/login",
                dataType:"json",
                type:"post",
                data:{name:name,password:password},
                success:function(mag){
                    if(mag=='200'){
                        alert('登录成功');
                    }else{
                        alert('登录失败');
                    }
                }
            })
        })
    })
</script>