<?php include("includes/header.php");?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php  
if(!empty($_GET['id'])){
  
    $vendor = Vendor::find_by_id($_GET['id']);

}
else{
    redirect("vendors.php");
}

if($vendor){

    $vendor->delete();
    redirect("vendors.php");
}
else{
    redirect("vendors.php");
}


?>