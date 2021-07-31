<?php
include("includes/header.php");
?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php
include("includes/navigation.php");
?>

<div class="container-fluid">
      <div class="row">
      <?php include("includes/sidebar.php"); ?>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
           
						<h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name;
						 ?>
						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
		
			<div id="admin-index-form">
		
			
				<h1>ALL VENDORS:</h1><form method="GET"  class="form-inline">
        <select required name='field' class="browser-default custom-select">
        <option value="all">Show All</option>
  <option value="id">Id</option>
  <option value="name">Name</option>
  <option value="email">Email</option>
  <option value="house">House/Appartment</option>
  <option value="city">City</option>
  <option value="district">District</option>
  <option value="state">State</option>
  <option value="pin">Pin</option>
  <option value="phone_no">Phone</option>

</select>
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" name="btnsearch" type="submit">Search</button>
  </form>
  <br>
				<a href="addvendor.php"><button class="btn btn-info">Add New</button></a>
				<hr>
				
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col"> Id</th>
				
					  <th scope="col">Name</th>
					  <th scope="col">Email</th>
						<th scope="col">House</th>
						<th scope="col">City</th>
						<th scope="col">District</th>
						<th scope="col">State</th>
						<th scope="col">Pincode</th>
						<th scope="col">Phone Number</th>
					  <th scope="col">Action</th>
				
					</tr>
				  </thead>
					<?php 
							
									  if(isset($_GET['btnsearch'])){
										$field = $_GET['field'];
										$search = $_GET['search'];
										if($field != 'all'){
										$sql = "SELECT * FROM vendor where `$field` LIKE '%$search%' ";
										$vendors = Vendor::find_by_query($sql);
										}
										else{
										$vendors = Vendor::find_all();
										}
									}
									else{
										$vendors = Vendor::find_all();
									}

					 foreach($vendors as $vendor){
					 
				 
				  ?>
				  
			<tr>
					 
					 
					  <td><?php echo $vendor->id; ?></td>
					  <td><?php echo $vendor->name; ?></td>
					  <td><?php echo $vendor->email; ?></td>
						<td><?php echo $vendor->house; ?></td>
						<td><?php echo $vendor->city; ?></td>
						<td><?php echo $vendor->district; ?></td>
						<td><?php echo $vendor->state; ?></td>
						<td><?php echo $vendor->pin; ?></td>
						<td><?php echo $vendor->phone_no; ?></td>
					  <td><a href="editvendor.php?id=<?php echo $vendor->id; ?>"><button class="btn btn-info">Edit</button></a> 
					  <?php if($session->user_role != "staff"){ ?>
					  <a onclick="return confirm('Are You sure');" href="deletevendor.php?id=<?php echo $vendor->id; ?>"><button class="btn btn-danger">Delete</button></a>
					  <?php } ?>
					  </td>
					  
			</tr>

					 <?php } ?>
			
				  
				  </tbody>
				</table>
				
	
        
          </div>
        </main>
      </div>
    </div>
	
    <?php
include("includes/footer.php");
?>