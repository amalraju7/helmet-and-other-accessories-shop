<?php include("includes/header.php");?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php  
if(!empty($_GET['id'])){
  
    $subcategory = Subcategory::find_by_id($_GET['id']);

}
else{
    redirect("subcategories.php");
}

if($subcategory){

    $subcategory->delete();
    redirect("subcategories.php");
}
else{
    redirect("subcategories.php");
}


?>