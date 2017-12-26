<?php
include("connect.php");
include("token.php");

$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$qid = (int)$_POST["qid"];
$content = $_POST["content"];

$images = $_POST["images"];

$sql = $pdo->prepare("INSERT INTO answer ( `uid`, `qid`, `content`, `images` ) VALUES ( ?, ?, ?, ?)");
if ($sql->execute(array($uid, $qid, $content, $images))) {
    $update = $pdo->prepare("UPDATE question SET `answerCount` = `answerCount` + 1 WHERE `id` = ?");
    $update->execute(array($qid));
    success_encode();
} else {
    other_encode(500, "回答失败");
}

