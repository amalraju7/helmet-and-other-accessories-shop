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
            <h1 class="h2"></h1>
						<h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name;
						 ?>
						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
		
			<div id="admin-index-form">
		
			
				<h1>ALL Addresses
					</h1>
			
				<hr>
				
				<table class="table">
				  <thead>
					<tr>
                    <th scope="col">Id</th>
                    <?php if(isset($_GET['id'])){ ?>
                        <th scope="col">User Id</th>
                    <?php } ?>
					  <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">House</th>
					  <th scope="col">City</th>
					  <th scope="col">District</th>
                        <th scope="col">State</th>
                        
                        <th scope="col">Pincode</th>
                        <th scope="col">Phone</th>

					  <th scope="col">Action</th>
				
					</tr>
				  </thead>
                  <?php 
                  if(isset($_GET['id'])){
                  $sql = "SELECT * FROM address WHERE user_id = '{$_GET['id']}'";
                  $addresses = Address::find_by_query($sql);
                  }
                  else{
                     $addresses = Address::find_all();
                  }
					
				
					 foreach($addresses as $address){
					
				 
				  ?>
			<tr>
				
                      <td><?php echo $address->id; ?></td>
                      <?php if(isset($_GET['id'])){ ?>
                        <td><?php echo $_GET['id']; ?></td>
                    <?php } ?>
					  <td><?php echo $address->address_fname; ?></td>
					  <td><?php echo $address->address_lname; ?></td>
					  <td><?php echo $address->house; ?></td>
					  <td><?php echo $address->city; ?></td>
                      <td><?php echo $address->district; ?></td>
                      <td><?php echo $address->state; ?></td>
                      <td><?php echo $address->pin; ?></td>
                      <td><?php echo $address->phone_no; ?></td> <?php if($session->user_role != "staff"){ ?>
						<td><a href="editaddress.php?id=<?php echo $address->id; ?>"><button class="btn btn-info">Edit</button></a> <a onclick="return confirm('Are You sure');" href="deleteaddress.php?id=<?php echo $address->id; ?>"><button class="btn btn-danger">Delete</button></a>
						</td>
                      <?php } ?>
					  
			</tr>
					 <?php  } ?>
				  
				  </tbody>
				</table>
				
	
        
          </div>
        </main>
      </div>
    </div>
	
    <?php
include("includes/footer.php");
?>