<?php require_once("admin/includes/init.php"); ?>
<?php require_once("admin/includes/functions.php"); ?>

<?php  
if(!empty($_GET['id'])){
  
    $address = Address::find_by_id($_GET['id']);

}
else{
    if(isset($_GET['page']))
    {
      redirect("viewaddress.php");
    }

    else{
    redirect("payment.php");
    }
}

if($address){

    $address->delete();
    if(isset($_GET['page']))
    {
      redirect("viewaddress.php");
    }
    else{
    redirect("payment.php");
}}
else{
    if(isset($_GET['page']))
    {
      redirect("viewaddress.php");
    }
    else{
    redirect("payment.php");
}}


?>