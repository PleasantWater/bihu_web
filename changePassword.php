<?php
include("connect.php");
include("token.php");

$uid = checkToken($pdo, $_POST["token"]);
$password = $_POST["password"];

if ($pdo->prepare("UPDATE person SET `password` = ? WHERE `id` = ?")->execute(array($password, $uid))) {
    $row["token"] = create_unique($pdo, $uid);
    success_encode($row);
} else {
    other_encode(500, "密码修改失败");
}

