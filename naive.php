<?php
include("connect.php");
include("token.php");


$token = $_POST["token"];
checkToken($pdo, $token);

$type = (int)$_POST["type"];
$id = (int)$_POST["id"];

$sql = null;

switch ($type) {
    case $TYPE_ANSWER:
        $sql = $pdo->prepare("UPDATE answer SET `exciting` = `exciting` - 1 WHERE `id` = ?");
        break;
    case $TYPE_QUESTION:
        $sql = $pdo->prepare("UPDATE question SET `exciting` = `exciting` - 1 WHERE `id` = ?");
        break;
    default:
        other_encode(400, "Too young!");
}

if ($sql && $sql->execute(array($id))) {
    success_encode($info = "naive");
} else {
    other_encode(500, "Too simple!");
}
