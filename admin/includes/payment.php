<?php 
class Payment extends Db_object{
    public $id;
    public $master_id;
    public $status;
    public $card_id;
    public $tracking_id;
    public $address_id;
    

    public static $db_table = "payment";
    public static $db_table_fields = array('master_id','status','card_id','tracking_id','address_id');
    

}



?>