<?php
include("connect.php");
include("token.php");


$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$type = (int)$_POST["type"];
$id = (int)$_POST["id"];

$sql = null;
$exciting = null;

switch ($type) {
    case $TYPE_ANSWER:
        $sql = $pdo->prepare("INSERT INTO exciting_answer (`uid`, `aid` ) VALUES ( ?, ?)");
        $exciting = $pdo->prepare("UPDATE question SET `exciting` = `exciting` + 1 WHERE `id` = ?");
        break;
    case $TYPE_QUESTION:
        $sql = $pdo->prepare("INSERT INTO exciting_question (`uid`, `qid` ) VALUES ( ?, ?)");
        $exciting = $pdo->prepare("UPDATE question SET `exciting` = `exciting` + 1 WHERE `id` = ?");
        break;
    default:
        other_encode(400, "一点都不exciting");
}

if ($sql && $sql->execute(array($uid, $id))) {
    $exciting->execute(array($id));
    success_encode(null, "excited");
} else {
    other_encode(500, "exciting失败");
}
