<?php require_once("admin/includes/init.php"); ?>
<?php require_once("admin/includes/functions.php"); ?>

<?php  
if(!empty($_GET['id'])){
  
    $card = Card::find_by_id($_GET['id']);

}
else{
    if(isset($_GET['page']))
    {
   
      redirect("viewcard.php");
    }
    else{
       redirect("payment.php");
    }
  
}

if($card){

    $card->delete();
    if(isset($_GET['page']))
    {
   
      redirect("viewcard.php");
    }
    else{
       redirect("payment.php");
    }
}
else{
    if(isset($_GET['page']))
    {
   
      redirect("viewcard.php");
    }
    else{
       redirect("payment.php");
    }
}


?>