<?php include("includes/header.php");?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php  
if(!empty($_GET['id'])){
  
    $user = User::find_by_id($_GET['id']);
    $role = $user->user_type;
    $sql = "SELECT * FROM address WHERE user_id = {$_GET['id']} ";
    $address = Address::find_by_query($sql);

    $address = array_shift($address);


}
else{
    redirect("users.php?role=$role");
}

if($user && $address){
    $address->delete();
    $user->delete_image_and_data();
    redirect("users.php?role=$role");
}
else{
    redirect("users.php?role=$role");
}


?>