<?php 
class Variant extends Db_object{
    public $id;
    public $product_id;
    public $color;
    public $images;
    public $selling_price;
    public $buying_price;
    public $quantity;
    public $filename;
    public $size;

    public static $db_table = "variant";
    public static $db_table_fields = array('product_id','color','size','images','selling_price','buying_price','quantity');
    


}



?>