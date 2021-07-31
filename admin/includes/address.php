<?php 
class Address extends Db_object{
    public $id;
    public $address_fname;
    public $address_lname;
    public $user_id;
    public $house;
    public $city;
    public $district;
    public $state;
    public $pin;
    public $phone_no;

  


    public static $db_table = "address";
    public static $db_table_fields = array('user_id','address_fname','address_lname','house','city','district','state','pin','phone_no');
    


}



?>