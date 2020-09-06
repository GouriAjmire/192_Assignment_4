<?php

class RestroData {
    
    private $Orderlist;

    function __construct(array $Orderlist) {
        if (sizeof($Orderlist)>0) {
            $this->Orderlist = $Orderlist;
        } else {
            throw new Exception("No Menu record available");
        }
    }

    public function getOrderName() {
        $OrderNameList = [];
        foreach($this->Orderlist as $menu_items) {
            $OrderNameList[] = array(
                "id"=>$menu_items['id'],
                "name"=>$menu_items['short_name'] . " " . $menu_items['name']
            );
        }

        return json_encode($OrderNameList);
    }

    public function getOrderByid($orderid) {
        $response = ["In-Valid ID"];
        if($orderid) {
            foreach($this->Orderlist as $menu_items) {
                if ($orderid == $menu_items['id']) {
                    $response = $menu_items;
                    break;
                }
            }
        }
        return json_encode($response);
    }

}
?>