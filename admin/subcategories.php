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
      
          <h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name; 						 ?> 						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
		
			<div id="admin-index-form">
		
			
				<h1>ALL SUBCATEGORIES:</h1><form method="GET"  class="form-inline">
        <select required name='field' class="browser-default custom-select">
        <option value="all">Show All</option>
  <option value="id">Id</option>
  <option value="name">Name</option>
  <option value="description">Description</option>
  

</select>
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" name="btnsearch" type="submit">Search</button>
  </form>
  <br>
				<?php if($session->user_role == "admin"){ ?>
				<a href="addsubcategory.php"><button class="btn btn-info">Add New</button></a>
				<?php } ?>
				<hr>
				
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col"> Id</th>
				
					  <th scope="col">Name </th>
                    
                      <th scope="col">Category Name</th>
					  <th scope="col">Description</th>

					 	<?php if($session->user_role == "admin"){ ?>
					  <th scope="col">Action</th>
						<?php } ?>
					</tr>
				  </thead>

					<?php 
							 if(isset($_GET['btnsearch'])){
								$field = $_GET['field'];
								$search = $_GET['search'];
								if($field != 'all'){
								$sql = "SELECT * FROM subcategory where `$field` LIKE '%$search%' ";
								$subcategories= Subcategory::find_by_query($sql);
								}
							else{
								$subcategories = Subcategory::find_all();
							}
							  }
							else{
								$subcategories = Subcategory::find_all();
							}
				
					 foreach($subcategories as $subcategory){
					 
				 
				  ?>
					<tr>
					<td><?php echo $subcategory->id; ?></td>
					
					  <td><?php echo $subcategory->name; ?></td>
					  <td><?php $category = Category::find_by_id($subcategory->category_id); echo $category->name; ?></td>
					  <td><?php echo $subcategory->description; ?></td>

						<?php if($session->user_role == "admin"){ ?>
					  <td><a href="editsubcategory.php?id=<?php echo $subcategory->id; ?>"><button class="btn btn-info">Edit</button></a> <a onclick="return confirm('Are You sure');" href="deletesubcategory.php?id=<?php echo $subcategory->id; ?>"><button class="btn btn-danger">Delete</button></a></td>
						<?php } ?>
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