
<?php include("includes/header.php");?>
<?php

if(isset($_GET['id'])){
$id = $_GET['id'];
$product = Product::find_by_id($id);
if($product->status == 0){


$product->status = 1;
}
else{
    $product->status = 0;
}
$product->save();
redirect("products.php");
} 

else {

    // redirect("products.php");

}?>