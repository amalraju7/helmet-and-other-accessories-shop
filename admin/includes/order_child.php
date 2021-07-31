<?php 
class Order_child extends Db_object{
    public $id;
    public $master_id;
    public $item_id;
    public $quantity;
    public $rate;

    public static $db_table = "order_child";
    public static $db_table_fields = array('master_id','item_id','quantity','rate');
    

}



?>