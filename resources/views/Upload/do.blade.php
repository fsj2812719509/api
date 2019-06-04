<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="/uploadDo" method="post" enctype="multipart/form-data">
        标题 : <input type="text" name="title" id="title">
        <br><br>
        <textarea name="content" id="content"></textarea>
        <br><br>
        图片 : <input type="file" name="image" id="image">
        <br><br>
        <input type="submit" value="发布文章">
    </form>
</body>
</html>