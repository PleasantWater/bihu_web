<?php
include("connect.php");
include("token.php");

$token = $_POST["token"];
$uid = checkToken($pdo, $token);
$qid = (int)$_POST["qid"];

$query = $pdo->prepare("SELECT * FROM favorite WHERE `uid` = ? AND `qid` = ?");
$cancel = $pdo->prepare("DELETE FROM favorite WHERE `uid` = ? AND `qid` = ?");

if ($query->execute(array($uid, $qid))) {
    if ($query->fetchAll(PDO::FETCH_NAMED)) {
        if ($cancel->execute(array($uid, $qid))) {
            success_encode();
        }
    } else {
        other_encode(400, "你未收藏过此问题");
    }
}
other_encode(500, "取消失败");
