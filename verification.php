<?php require_once("admin/includes/init.php"); ?>
<?php if(isset($_GET['vkey'])){
    global $database;
$vkey =$_GET['vkey'];
$sql = "SELECT * FROM users WHERE vkey = '". $vkey . "' LIMIT 1 ";

  echo $sql;    

$user = User::find_by_query($sql);
$user = array_shift($user);
if($user->verified){
   redirect("failure.php"); 
}
else
{  $user->verified = 1;
    $user->save();
    redirect("success.php");
  

}
}

?>