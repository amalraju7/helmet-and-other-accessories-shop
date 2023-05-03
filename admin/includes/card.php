<?php 
class Card extends Db_object{
    public $id;
    public $user_id;
    public $name;
    public $card_number;
    public $expiry;
   
  
    


    public static $db_table = "card";
    public static $db_table_fields = array('user_id','name','card_number','expiry');
    


}



?>