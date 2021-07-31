<?php include("includes/header.php");?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php  
if(!empty($_GET['id'])){
  
    $category = Category::find_by_id($_GET['id']);

    



}
else{
    redirect("categories.php");
}

if($category){

    $category->delete();
    redirect("categories.php");
}
else{
    redirect("categories.php");
}


?>