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
		
			
				<h1>ALL <?php if(isset($_GET['role'])){ 
					if($_GET['role'] == "staff" ){
						echo "STAFF:";
					}
					else if($_GET['role'] == "admin" ){
						echo	"ADMIN:";
					}
					else{
						echo "CUSTOMER:";
					} } ?>
					</h1>
					<form method="GET"  class="form-inline">
        <select required name='field' class="browser-default custom-select">
        <option value="all">Show All</option>
  <option value="id">Id</option>
  <option value="first_name">First Name</option>
  <option value="last_name">Last Name</option>
  <option value="date">Date of joining</option>

</select>
<input type="text" hidden name='role' value="<?php echo $_GET['role']; ?>">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" name="btnsearch" type="submit">Search</button>
  </form>
  <br>
  <?php if($session->user_role == "admin"){ ?>
				<a href="adduser.php"><button class="btn btn-info">Add New</button></a>
  <?php } ?>
				<hr>
				
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col">User Id</th>
					  <th scope="col">User Image</th>
					  <th scope="col">First Name</th>
					  <th scope="col">Last Name</th>
					  <th scope="col">Email</th>
					  <th scope="col">Verified</th>
						<th scope="col">User Type</th>
						<th scope="col">Status</th>
					  <th scope="col">Action</th>
				
					</tr>
				  </thead>
				  <?php if(isset($_GET['btnsearch'])){
  $field = $_GET['field'];
  $search = $_GET['search'];
  if($field != 'all'){
  $sql = "SELECT * FROM users where `$field` LIKE '%$search%' ";
  $users = User::find_by_query($sql);
  }
else{
	$users = User::find_all();
}
  }
else{
					 $users = User::find_all();
}
					 $user_role = $_GET['role'];
				
					 foreach($users as $user){
						if($user->user_type == $user_role){
				 
				  ?>
			<tr>
				
					  <td><?php echo $user->id; ?></td>
					  <td><?php echo "<img class='admin-photo-thumbnail user-image' src={$user->image_path_and_placeholder()}>"; ?></td>
					  <td><?php echo $user->first_name; ?></td>
					  <td><?php echo $user->last_name; ?></td>
					  <td><?php echo $user->email; ?></td>
					  <td><?php echo $user->verified; ?></td>
						<td><?php echo $user->user_type; ?></td>
						<td><?php echo $user->status; ?></td>
						<td>
					   <?php if($session->user_role != "staff"){ ?>
						<a href="edituser.php?id=<?php echo $user->id; ?>"><button class="btn btn-info">Edit</button></a> <a onclick="return confirm('Are You sure');" href="deleteuser.php?id=<?php echo $user->id; ?>"><button class="btn btn-danger">Delete</button></a>
						<a href="blockuser.php?id=<?php echo $user->id; ?>"><button class="btn btn-warning"><?php if($user->status==1){ echo"Block"; } else{
							 echo"Unblock"; } ?> </button></a> <?php } ?>	<a href="viewaddress.php?id=<?php echo $user->id; ?>"><button class="btn btn-success">Address</button></a></td>
					  
			</tr>
					 <?php } } ?>
				  
				  </tbody>
				</table>
				
	
        
          </div>
        </main>
      </div>
    </div>
	
    <?php
include("includes/footer.php");
?>