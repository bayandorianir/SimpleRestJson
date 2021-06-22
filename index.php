<?php

require_once 'db.php';
$data = new Database();
$tablename = "ms";

if (isset($_GET['delete'])) {
    $arr = json_decode($_GET['delete'],true);
    $arrs = array_keys($arr);
    $data->_delete($tablename, $arrs[0], $arr[$arrs[0]]);
    echo "ok";
}

if (isset($_GET['insert'])) {
    $arr = json_decode($_GET['insert'], true);
    $data->_insertData($tablename, $arr);
    echo "ok";
}

if (isset($_GET['get'])) {
    $arr = json_decode($_GET['get'],true);
    $arrs = array_keys($arr);
    $tr = $data->_search($tablename);
    $reult = array();
    foreach ($tr as $key => $value) {
        if ($value[$arrs[0]] == $arr[$arrs[0]]) {
            array_push($reult, $value);
        }
    }
    echo json_encode($reult);
}
        