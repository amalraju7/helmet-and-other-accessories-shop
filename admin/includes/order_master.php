<?php 
class Order_master extends Db_object{
    public $id;
    public $cust_id;
    public $date;
    public $total_amount;
    public $status;
    public $expected;
    

    public static $db_table = "order_master";
    public static $db_table_fields = array('cust_id','date','total_amount','status','expected');
    

}



?>