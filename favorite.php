<?php
include("connect.php");
include("token.php");


$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$qid = (int)$_POST["qid"];

$query = $pdo->prepare("SELECT * FROM favorite WHERE `uid` = ? AND `qid` = ?");
$sql = $pdo->prepare("INSERT INTO favorite (`uid`, `qid` ) VALUES ( ?, ?)");

if ($query->execute(array($uid . $qid))) {
    if ($query->fetchAll(PDO::FETCH_NAMED)) {
        other_encode(400, "你已收藏过此问题");
    } else {
        if ($sql->execute(array($uid, $qid))) {
            success_encode();
        }
    }
}
other_encode(500, "收藏失败");
