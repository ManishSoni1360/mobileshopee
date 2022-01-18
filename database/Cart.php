<?php

class Cart {
    public $db = null;

    public function __construct(DBController $db)
    {
        if(!isset($db->con)) return null;
        $this->db = $db;
    }

    public function insertToCart($params = null, $table = 'cart') {
        if($this->db->con != null) {
            if($params != null) {
                $column = implode(',', array_keys($params));
                $values = implode(',', array_values($params));
                $query_string = sprintf('INSERT INTO %s(%s) VALUES(%s)', $table, $column, $values);
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    public function addToCart($userid, $itemid) {
        if(isset($userid) && isset($itemid)) {
            $params = array (
                'user_id' => $userid,
                'item_id' => $itemid
            );
            $result = $this->insertToCart($params);
            if($result) {
                header('Location:', $_SERVER['PHP_SELF']);
            }
        }
    }

    // Delete Cart Items
    public function deleteCart($itemid = null, $table = 'cart') {
        if($itemid != null) {
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$itemid}");

            if($result) {
                header('Location:', $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // calculate sub total
    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $item){
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f' , $sum);
        }
    }

    // get item_it of shopping cart list
    public function getCartId($cartArray = null, $key = "item_id"){
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }
}