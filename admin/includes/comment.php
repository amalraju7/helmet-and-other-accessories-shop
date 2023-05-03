<?php 
class Comment extends Db_object{
    public $id;
    public $product_id;
    public $user_id;
    public $title;
    public $description;

    public $rating;
  
  
    


    public static $db_table = "comment";
    public static $db_table_fields = array('product_id','user_id','title','description','rating');
    


}



?>