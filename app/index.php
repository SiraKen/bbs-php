<?php
$weekdays = ['日', '月', '火', '水', '木', '金', '土'];
$board_name = isset($_GET['board_name']) ? $_GET['board_name'] : 'main';
$board_filename = 'board/' . $board_name . '.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $name = $_POST["name"] ?: "名無しさん";
    $email = $_POST["email"] ?: "";
    $message = $_POST["message"] ?: "";
    $id = $_SERVER["REMOTE_ADDR"];
    $created_at = date("Y-m-d H:i:s");

    $content = $name . "\t" . $email . "\t" . $message . "\t" . $id . "\t" . $created_at . "\n";

    $fp = fopen($board_filename, "a");
    fwrite($fp, $content);
    fclose($fp);
}

$fp = fopen($board_filename, "r");
$filesize = filesize($board_filename);
$messages = [];

while ($line = fgets($fp))
{
    $tmp = explode("\t", $line);
    $tmp_array = [
        "name" => $tmp[0],
        "email" => $tmp[1],
        "message" => $tmp[2],
        "id" => $tmp[3],
        "created_at" => $tmp[4],
    ];
    $messages[] = $tmp_array;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $board_name ?> | BBS</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div id="app">
    <div class="thread">
        <h1 class="thread--name">
            <small>【1:<?= count($messages) ?>】</small><span><?= $board_name ?></span>
        </h1>
        <?php if (count($messages) > 0) : ?>
        <dl>
            <?php foreach ($messages as $index => $message): ?>
            <dt>
                <span class="id"><?= $index + 1 ?></span>
                名前：<span class="thread--user-name"><?= $message['name'] ?></span>
                <?= date('Y/m/d', strtotime($message['created_at'])) ?>(<?= $weekdays[date('w', strtotime($message['created_at']))] ?>) ID:<?= $message['id'] ?>
            </dt>
            <dd><?= $message['message'] ?></dd>
            <?php endforeach; ?>
        </dl>
        <?php else: ?>
            <p>投稿がありません</p>
        <?php endif; ?>
    </div>
    <div class="form">
        <form method="post">
            <h2>書き込み</h2>
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

