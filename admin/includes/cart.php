<?php 
class Cart extends Db_object{
    public $id;
    public $user_id;
    public $variant_id;
    public $quantity;
   
    public $date;
    public $status;


    public static $db_table = "cart";
    public static $db_table_fields = array('user_id','variant_id','quantity','date','status');
    


}



?>