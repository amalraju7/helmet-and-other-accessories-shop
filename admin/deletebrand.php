<?php include("includes/header.php");?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php  
if(!empty($_GET['id'])){
  
    $brand = Brand::find_by_id($_GET['id']);

}
else{
    redirect("brands.php");
}

if($brand){

    $brand->delete();
    redirect("brands.php");
}
else{
    redirect("brands.php");
}


?>