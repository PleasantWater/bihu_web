<?php
include("connect.php");
include("token.php");

$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$aid = (int)$_POST["aid"];
$qid = (int)$_POST["qid"];

$query = $pdo->prepare("SELECT * FROM question WHERE `id` = ? AND `uid` = ?");

if ($query->execute(array($qid, $uid))) {
    if ($query->fetch(PDO::FETCH_NAMED)) {
        $query = $pdo->prepare("UPDATE answer SET `best` = TRUE WHERE `qid` = ? AND `id` = ?");
        if ($query->execute(array($qid, $aid))) {
            success_encode();
        }
    } else {
        other_encode(404, "未找到对应回答");
    }
}
other_encode(500, "采纳失败");