<?php 
class Brand extends Db_object{
    public $id;
    public $name;
    public $description;

    public $vendor_id;
  
    


    public static $db_table = "brand";
    public static $db_table_fields = array('name','description','vendor_id');
    


}



?>