<?php
function success_encode($data = null, $info = null)
{
    header("Content-Type: application/json");
    $result["status"] = 200;
    if ($info) {
        $result["info"] = $info;
    } else {
        $result["info"] = "success";
    }
    if ($data) {
        $result['data'] = $data;
    }
    echo json_encode($result);
    exit(0);
}

function other_encode($status, $info, $data = null)
{
    header("Content-Type: application/json");
    $result["status"] = $status;
    $result["info"] = $info;
    if ($data) {
        $result['data'] = $data;
    }
    echo json_encode($result);
    exit(0);
}
