<?php require_once("admin/includes/init.php"); ?>

<?php  
if(!empty($_GET['id'])){
  
    $cart = Cart::find_by_id($_GET['id']);

}
else{
    redirect("cart.php");
}

if($cart){

    $cart->delete();
    redirect("cart.php");
}
else{
    redirect("cart.php");
}


?>