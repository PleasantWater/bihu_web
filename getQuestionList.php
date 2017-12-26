<?php
include("connect.php");
include("token.php");

$dataInfo = array("totalCount" => 0, "totalPage" => 0, "questions" => null);

$uid = checkToken($pdo, $_POST["token"]);
$page = (int)$_POST["page"];
$count = (int)$_POST["count"];
if (!$count) {
    $count = 10;
}
$start = $page * $count;

$sql = $pdo->prepare("
    SELECT
      question.id,
      question.title,
      question.content,
      question.images,
      question.date,
      question.exciting,
      question.naive,
      question.recent,
      question.answerCount,
      question.uid    AS authorId,
      person.username AS authorName,
      person.avatar   AS authorAvatar
    FROM person
      RIGHT JOIN question ON person.id = question.uid
    ORDER BY IFNULL(`recent`, `date`) DESC
    LIMIT ?, ?
");

$sql->execute(array($page * $count, $count));
$data = $sql->fetchAll(PDO::FETCH_NAMED);
foreach ($data as &$e) {
    //$sql = $pdo->prepare("SELECT `url` FROM image WHERE `qid` = ? AND `uid` = ?");
    $sql->execute(array($e["id"], $e["authorId"]));
    //$e["images"] = $sql->fetchAll(PDO::FETCH_NAMED);

    $sql = $pdo->prepare("SELECT * FROM exciting_question WHERE `qid` = ? AND `uid` = ?");
    $sql->execute(array($e["id"], $uid));
    if ($sql->fetch(PDO::FETCH_NAMED)) {
        $e["is_exciting"] = true;
    } else {
        $e["is_exciting"] = false;
    }
    $sql = $pdo->prepare("SELECT * FROM naive_question WHERE `qid` = ? AND `uid` = ?");
    $sql->execute(array($e["id"], $uid));
    if ($sql->fetch(PDO::FETCH_NAMED)) {
        $e["is_naive"] = true;
    } else {
        $e["is_naive"] = false;
    }
    $sql = $pdo->prepare("SELECT * FROM favorite WHERE `qid` = ? AND `uid` = ?");
    $sql->execute(array($e["id"], $uid));
    if ($sql->fetch(PDO::FETCH_NAMED)) {
        $e["is_favorite"] = true;
    } else {
        $e["is_favorite"] = false;
    }
}
$totalCount = $pdo->query("SELECT COUNT(*) AS count FROM question")->fetch(PDO::FETCH_NAMED);
$dataInfo["questions"] = $data;
$dataInfo["totalCount"] = (int)$totalCount['count'];
$dataInfo["curPage"] = $page;
$dataInfo["totalPage"] = (int)($totalCount['count'] / $count) + 1;

success_encode($dataInfo);