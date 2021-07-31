<?php include("includes/header.php");?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php  
if(!empty($_GET['id'])){
  
    $product = Product::find_by_id($_GET['id']);
    $sql = "SELECT * FROM variant WHERE product_id = {$_GET['id']} ";
    $variants = Variant::find_by_query($sql);




}
else{
    redirect("users.php");
}

if($product ){
    foreach($variants as $variant){
    $variant->delete_multiple_image_and_data();
    print_r($variant);
    }
    $product->delete();
    redirect("products.php");
}
else{
    redirect("products.php");
}


?>