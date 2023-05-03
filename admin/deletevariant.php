<?php include("includes/header.php");?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php  
if(!empty($_GET['id'])){
  
    $variant = variant::find_by_id($_GET['id']);

}
else{
    redirect("variants.php");
}

if($variant){

    $variant->delete();
    redirect("variants.php");
}
else{
    redirect("variants.php");
}


?>