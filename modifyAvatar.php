<?php
include("connect.php");
include("token.php");

$avatar = $_POST["avatar"];
$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$sql = $pdo->prepare("UPDATE person SET `avatar` = ? WHERE `id` = ?");

if (!$avatar) {
	other_encode(400, "缺少字段avatar");
} else if ($sql->execute(array($avatar, $uid))) {
    success_encode();
} else {
    other_encode(500, "更改失败");
}
