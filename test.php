<?php
session_start();

$data1 = "data";

$dataarr = array("data" => "r่อมึงตาย", "data2" => "2");
$data = json_encode($dataarr);
$data = json_decode($data, true);
print_r($dataarr);
print_r($data['data']);
if ($data['data'] = "r่อมึงตาย"){
    header("Location: index.php");
}
?>