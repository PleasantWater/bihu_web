<?php
function success_encode($data = null, $info = "success")
{
    $result["status"] = 200;
    $result["info"] = $info;
    if ($data) {
        $result['data'] = $data;
    }
    header("Content-Type: application/json");
    echo json_encode($result);
    exit(0);
}

function other_encode($status, $info, $data = null)
{
    $result["status"] = $status;
    $result["info"] = $info;
    if ($data) {
        $result['data'] = $data;
    }
    header("Content-Type: application/json");
    echo json_encode($result);
    exit(0);
}
