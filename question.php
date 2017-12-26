<?php
include("connect.php");
include("token.php");

$token = $_POST["token"];
$title = $_POST["title"];
$content = $_POST["content"];
$images = $_POST["images"];

$uid = checkToken($pdo, $token);

//$sql = $pdo->prepare("INSERT INTO question ( uid , title , content , date ) VALUES (   ?, ?, ?, now())");
$sql = $pdo->prepare("INSERT INTO question ( `uid`, `title`, `content`, `images` ) VALUES (  ?, ?, ?, ? )");

if ($sql->execute(array($uid, $title, $content, $images))) {
    success_encode();
} else {
    other_encode(500, "提问失败");
}
