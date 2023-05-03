<?php 
class Purchase_master extends Db_object{
    public $id;
    public $vendor_id;
    public $staff_id;
    public $date;
    public $total_amount;

    public static $db_table = "purchase_master";
    public static $db_table_fields = array('vendor_id','staff_id','date','total_amount');
    

}



?>