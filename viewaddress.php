<?php
include_once("includes/header.php");
include_once("includes/navigation.php");
?>
<?php
$u = User::find_by_id($session->user_id);
if(isset($_GET['aid'])){
    $u->address_id = $_GET['aid'];
    $u->save();
}

?>
    <main  >
       

       
<section class="section-address">
<h1 class="heading-secondary"> Your Addresses: </h1>
<div class="address__wrapper">
<?php
$sql=" SELECT * FROM address WHERE user_id = '$session->user_id' ";
$addresses = Address::find_by_query($sql);
foreach($addresses as $address){
?>
<?php $u = User::find_by_id($session->user_id); 
        $add_id = $address->id;
        $uadd_id = $u->address_id;
        if($add_id == $uadd_id ){  ?>
    <div style="border: 5px solid red; filter:brightness(1.5); " class="address__card">
        <?php } 
        else {?>
          <div  class="address__card">
        <?php 
        }
        if($add_id == $uadd_id ){ ?>
        <p class="address__seleceted">SELECTED</p> <?php } ?>
    <?php echo $address->address_fname; ?>  <?php echo " $address->address_lname"; ?> <br>
    <?php echo $address->house; ?> <br>
    <?php echo $address->city; ?> <br>
    <?php echo $address->district; ?> <br>
    <?php echo $address->state; ?> <br>
    <?php echo $address->pin; ?> <br>
India <br>
Phone:    <?php echo $address->phone_no; ?>  <br> <br>
<a href="editaddress.php?id=<?php echo $address->id ?>&page=1">Edit</a> <a href="deleteaddress.php?id=<?php echo $address->id ?>&page=1">Delete</a> <a href="viewaddress.php?aid=<?php echo $address->id ?>">Select</a>
    </div>
<?php } ?>
   
    <div class="address__card">
        <a href="address.php">
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
  <path fill="#61B3C4"
        d="M 38.999, 7
           H 11
           c -2.25, 0,   -4, 1.75,   -4, 4
           v 27.999
           C 7, 41.249,   8.75, 43,   11, 43
           h 27.999
           C 41.249, 43,   43, 41.249,   43, 38.999
           V 11
           C 43, 8.75,   41.249, 7,   38.999, 7
           z"/>
  <path fill="#FFFFFF" 
        d="M 35.001, 26.999
           H 27
           V 35
           h -3.999
           v -8.001
           h -8.002
           V 23
           h 8.002
           v -8
           H 27
           v 8
           h 8.001
           V 26.999
           z"/>
  </svg></a>
    </div>

</div>
</section>
          <?php include_once("includes/footer.php"); ?>

</body>
</html>