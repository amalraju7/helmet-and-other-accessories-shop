<?php 
class Vendor extends Db_object{
    public $id;
    public $name;
    public $email;
    public $house;
    public $city;
    public $district;
    public $state;
   public $pin;
   public $phone_no;
  
    


    public static $db_table = "vendor";
    public static $db_table_fields = array('name','name','email','house','city','district','state','pin','phone_no');
    
    


}



?>