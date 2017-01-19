<?php
include("connect.php");
include("token.php");


$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$type = (int)$_POST["type"];
$id = (int)$_POST["id"];

$query = null;
$sql = null;
$naive = null;

switch ($type) {
    case $TYPE_ANSWER:
        $query = $pdo->prepare("SELECT * FROM naive_answer WHERE `uid` = ? AND `aid` = ?");
        $sql = $pdo->prepare("INSERT INTO naive_answer (`uid`, `aid` ) VALUES ( ?, ?)");
        $naive = $pdo->prepare("UPDATE answer SET `naive` = `naive` + 1 WHERE `id` = ?");
        break;
    case $TYPE_QUESTION:
        $query = $pdo->prepare("SELECT * FROM naive_question WHERE `uid` = ? AND `qid` = ?");
        $sql = $pdo->prepare("INSERT INTO naive_question (`uid`, `qid` ) VALUES ( ?, ?)");
        $naive = $pdo->prepare("UPDATE question SET `naive` = `naive` + 1 WHERE `id` = ?");
        break;
    default:
        other_encode(400, "Too young!");
}

if ($query && $query->execute(array($uid, $id))) {
    if ($query->fetchAll(PDO::FETCH_NAMED)) {
        other_encode(400, "请勿重复提交");
        $sql = null;
    }
}

if ($sql && $sql->execute(array($uid, $id))) {
    $naive->execute(array($id));
    success_encode(null, "naive");
}
other_encode(500, "Too simple!");

