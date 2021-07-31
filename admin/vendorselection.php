<?php
include("includes/header.php");
?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php
include("includes/navigation.php");
?>
<?php 

if(isset($_GET['id'])){
$id=$_GET['id'];
$pm = new Purchase_master();
$pm->vendor_id = $id;
$pm->staff_id = $session->user_id;
$pm->date = date("d/m/Y");
$pm->total = 0;

$pm->save();
$_SESSION['master_id']=mysqli_insert_id($database->connection);
redirect("purchase.php?id=$id");
}

?>
<div class="container-fluid">
      <div class="row">
      <?php include("includes/sidebar.php"); ?>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      
            <h6>Howdy  | Your role is </h6>
          </div>
		
			<div id="admin-index-form">
		
			
                <h1>Select Vendor :</h1>
                <?php $vendors = Vendor::find_all();
                foreach($vendors as $vendor) { ?>
                <a href="vendorselection.php?id=<?php echo $vendor->id; ?>">
				<div class="card text-white bg-primary mb-3 mr-3" style="max-width: 18rem;">
  <div class="card-header"><?php echo $vendor->name; ?></div>
  <div class="card-body">
    <h5 class="card-title">Email :</h5>
    <p class="card-text"><?php echo $vendor->email; ?></p>
    <h5 class="card-title">Address :</h5>
    <p class="card-text"><?php echo $vendor->house; ?></p>
    <p class="card-text"><?php echo $vendor->city; ?></p>
    <p class="card-text"><?php echo $vendor->district; ?></p>
    <p class="card-text"><?php echo $vendor->state; ?></p>
    <p class="card-text"><?php echo $vendor->pin; ?></p>
    <h5 class="card-title">Phone Number :</h5>
    <p class="card-text"><?php echo $vendor->phone_no; ?></p>
  </div>
</div></a>
                <?php } ?>

				<hr>
				
				
				
	
        
          </div>
        </main>
      </div>
    </div>
	
    <?php
include("includes/footer.php");
?>