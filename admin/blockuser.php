<?php include("includes/header.php");?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php  
if(!empty($_GET['id'])){
  
    $user = User::find_by_id($_GET['id']);
    $role = $user->user_type;
  


}
else{
    redirect("users.php?role=$role");
}

if($user ){
    if($user->status == 0){
   $user->status = 1;
    }
    else{
        $user->status = 0;  
    }
$user->save();
     redirect("users.php?role=$role");
}
else{
    redirect("users.php?role=$role");
}


?>