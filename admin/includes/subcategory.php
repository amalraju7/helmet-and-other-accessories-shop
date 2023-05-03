<?php 
class Subcategory extends Db_object{
    public $id;
    public $category_id;
   
    public $name;
    public $description;
  
  
    


    public static $db_table = "subcategory";
    public static $db_table_fields = array('category_id','name','description');
    


}



?>