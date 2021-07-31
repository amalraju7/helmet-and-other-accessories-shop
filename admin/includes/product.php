<?php 
class Product extends Db_object{
    public $id;
  
    public $name;
    public $category;
    public $subcategory;
    public $brand;
    public $description;
    public $features;
    public $keywords;
    public $status;


    public static $db_table = "product";
    public static $db_table_fields = array('name','category','subcategory','brand','description','features','keywords','status');
    


}



?>