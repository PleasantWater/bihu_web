<?php
include("connect.php");
include("jsonWrapper.php");

$dataInfo = array("totalCount" => 0, "totalPage" => 0, "answers" => null);

$uid = checkToken($pdo, $_POST["token"]);
$page = (int)$_POST["page"];
$count = (int)$_POST["count"];
$qid = (int)$_POST["qid"];

if (!$count) {
    $count = 10;
}

$sql = $pdo->prepare("
    SELECT
      answer.id,
      answer.content,
      answer.date,
      answer.best,
      answer.exciting,
      answer.naive,
      answer.uid      AS authorId,
      person.username AS authorName,
      person.avatar   AS authorAvatar
    FROM person
      RIGHT JOIN answer ON person.id = answer.uid
    WHERE qid = ?
    ORDER BY `date`
    LIMIT ?, ?
");

$sql->execute(array($qid, $page * $count, $count));
$data = $sql->fetchAll(PDO::FETCH_NAMED);
foreach ($data as &$e) {
    $sql = $pdo->prepare("SELECT `url` FROM image WHERE `aid` = ? AND `uid` = ?");
    $sql->execute(array($e["id"], $e["authorId"]));
    $e["images"] = $sql->fetchAll(PDO::FETCH_NAMED);

    $sql = $pdo->prepare("SELECT * FROM exciting_answer WHERE `aid` = ? AND `uid` = ?");
    $sql->execute(array($e["id"], $uid));
    if ($sql->fetch(PDO::FETCH_NAMED)) {
        $e["is_exciting"] = true;
    } else {
        $e["is_exciting"] = false;
    }
    $sql = $pdo->prepare("SELECT * FROM naive_answer WHERE `aid` = ? AND `uid` = ?");
    $sql->execute(array($e["id"], $uid));
    if ($sql->fetch(PDO::FETCH_NAMED)) {
        $e["is_naive"] = true;
    } else {
        $e["is_naive"] = false;
    }
}
$sql = $pdo->prepare("SELECT COUNT(*) AS count FROM answer WHERE qid = ?");
$sql->execute(array($qid));
$totalCount = $sql->fetch(PDO::FETCH_NAMED);
$dataInfo["answers"] = $data;
$dataInfo["totalCount"] = (int)$totalCount['count'];
$dataInfo["curPage"] = $page;
$dataInfo["totalPage"] = (int)($totalCount['count'] / $count) + 1;

success_encode($dataInfo);
