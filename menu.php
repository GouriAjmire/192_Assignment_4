<?php
header("Content-type: application/json");
require 'Data.php';

$req = $_GET['req'] ?? null;

if ($req) {
    $jsonData = file_get_contents("restaurant.json");
    $dataList = json_decode($jsonData, true)['menu_items'];
    try {
        $menuData = new RestroData($dataList);
    } catch (Exception $th) {
        echo json_encode([$th->getMessage()]);
        return;
    }
}

switch ($req) {
    case 'name_list':
        echo $menuData->getOrderName();
        break;

    case "restro":
        $orderid = $_GET['id'] ?? null;
        echo $menuData->getOrderByid($orderid);
        break;
    
    default:
        echo json_encode(["In-valid request"]);
        break;
}

?>