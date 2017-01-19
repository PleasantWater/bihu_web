<?php
include("connect.php");
include("token.php");


$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$type = (int)$_POST["type"];
$id = (int)$_POST["id"];

$query = null;
$sql = null;
$exciting = null;

switch ($type) {
    case $TYPE_ANSWER:
        $query = $pdo->prepare("SELECT * FROM exciting_answer WHERE `uid` = ? AND `aid` = ?");
        $sql = $pdo->prepare("INSERT INTO exciting_answer (`uid`, `aid` ) VALUES ( ?, ?)");
        $exciting = $pdo->prepare("UPDATE answer SET `exciting` = `exciting` + 1 WHERE `id` = ?");
        break;
    case $TYPE_QUESTION:
        $query = $pdo->prepare("SELECT * FROM exciting_question WHERE `uid` = ? AND `qid` = ?");
        $sql = $pdo->prepare("INSERT INTO exciting_question (`uid`, `qid` ) VALUES ( ?, ?)");
        $exciting = $pdo->prepare("UPDATE question SET `exciting` = `exciting` + 1 WHERE `id` = ?");
        break;
    default:
        other_encode(400, "一点都不exciting");
}

if ($query && $query->execute(array($uid, $id))) {
    if ($query->fetchAll(PDO::FETCH_NAMED)) {
        other_encode(400, "请勿重复提交");
        $sql = null;
    }
}

if ($sql && $sql->execute(array($uid, $id))) {
    $exciting->execute(array($id));
    success_encode(null, "excited");
}
other_encode(500, "exciting失败");

