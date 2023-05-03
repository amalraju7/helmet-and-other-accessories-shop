<?php 
class Category extends Db_object{
    public $id;
    public $name;
    public $description;
  
    


    public static $db_table = "category";
    public static $db_table_fields = array('name','description');
    


}



?>