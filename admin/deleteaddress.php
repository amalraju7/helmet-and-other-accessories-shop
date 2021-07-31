<?php include("includes/header.php");?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php  
if(!empty($_GET['id'])){
  
    $address = Address::find_by_id($_GET['id']);

    $id = $address->user_id;



}
else{
    redirect("../login.php");
}

if($address){

    $address->delete();
    redirect("viewaddress.php?id=$id");
}
else{
    redirect("viewaddress.php?id=$id");
}


?>