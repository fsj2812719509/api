<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    城市名称  : <input type="text" name="wind" id="wind">
    <input type="button" id="btn" value="查询">
</body>
</html>
<script src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/md5.js"></script>
<script type="text/javascript">
    $(function(){
        $('#btn').click(function(){
            var wind = $('#wind').val();
            $.ajax({
                url : "/wind",
                data : {wind:wind},
                type : "post",
                success : function ( msg ) {
                    console.log(msg);
                }
            });

        });
    })

</script>