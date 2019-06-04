<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="">
        姓名 : <input type="text" name="username" id="username">
        <br><br>
        邮箱 : <input type="text" name="email" id="email">
        <br><br>
        密码 : <input type="password" name="password" id="password">
        <br><br>
        <input type="button" id="btn" value="注册">
    </form>
</body>
</html>
<script src="/js/jquery-1.9.1.min.js"></script>
<script>
    $(function(){
        $("#btn").click(function(){
            var name = $("#username").val();
            var email = $("#email").val();
            var password = $("#password").val();

            $.ajax({
                url:"/register",
                dataType:"json",
                type:"post",
                data:{name:name,password:password,email:email},
                success:function(mag){
                    if(mag ==1){
                        alert('注册成功');
                        location.href='http://www.api2.com/loginList';
                    }else{
                        alert('注册失败');
                    }
                }
            })
        })
    })
</script>