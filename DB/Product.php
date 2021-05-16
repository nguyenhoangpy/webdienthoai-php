<?php
class Product{
    public function __construct($db){
        if(!isset($db->connection)) return null;
        $this->db = $db;
    }
    public function getData($table){
        $result = $this->db->connection->query("SELECT * FROM {$table}");
        $resultArray = array();
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function getCart($userid){
        $result = $this->db->connection->query("SELECT a.quantity, a.sum, b.item_id, b.item_name, b.item_brand, b.item_image  FROM cart a, product b where a.user_id=$userid and a.item_id = b.item_id");
        $resultArray = array();
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function getSale(){
        $result = $this->db->connection->query("SELECT * FROM product WHERE item_price_sale <> 0");
        $resultArray = array();
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        return $resultArray;
    }


    public function list_category($table='product'){
        $result = $this->db->connection->query("SELECT distinct item_brand FROM {$table}");
        $resultArray = array();
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function list_bycategory($brand = null,$table='product'){
        $result = $this->db->connection->query("SELECT * FROM {$table} where item_brand={$brand}");
        $resultArray = array();
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        return $resultArray;
    }
    
    
}
$product = new Product($db);
