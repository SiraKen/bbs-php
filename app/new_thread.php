<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBS</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div id="app">
    <div class="form">
        <form method="post">
            <h2>新規スレッド作成</h2>
            <!--  -->
            <b>名前:</b>
            <input type="text" id="name" name="name">
            <!--  -->
            <b>E-mail:</b>
            <input type="text" id="email" name="email"><br>
            <!--  -->
            <textarea name="message" id="message" cols="12" rows="4" required></textarea>
            <input type="submit" name="send" value="書き込む">
        </form>
    </div>
</div>
</body>
</html>
