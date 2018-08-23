<?php
error_reporting(E_ALL);
ini_set('memory_limit', '-1');

include_once '../processing/methods.php';

$obj = new methods();

try {
    if (isset($_POST['from'])) {
        $data = $obj->getVideoDetails($_POST['from']);
    } else {
        $data = '';
    }
    echo json_encode($data);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}