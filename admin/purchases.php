<?php
include("includes/header.php");
?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php
include("includes/navigation.php");
?>

<?php
$sql = "SELECT * FROM purchase_master WHERE total_amount = 0 ";
$pms = Purchase_master::find_by_query($sql);
foreach($pms as $pm){
  $pm->delete();
}
$sql = "SELECT * FROM purchase_child WHERE rate = 0 ";
$pcs = Purchase_child::find_by_query($sql);
foreach($pcs as $pc){
  $pm = Purchase_master::find_by_id($pc->master_id);
  $pc->delete();
}


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
		
			
				<h1> Purchases :</h1><form method="POST"  class="form-inline">
        <select required name='field' class="browser-default custom-select">
        <option value="all">All</option>
  <option value="id">Id</option>
  <option value="date">Date</option>
  <option value="total_amount">Total Amount</option>
  <option value="status">Status</option>
  <option value="expected">Expected</option>
</select>
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" name="btnsearch" type="submit">Search</button>
  </form>
				
				<hr>
				
			<table class="table table-hover">
      <thead>
        <tr>
          <th>id</th>
          <th>Vendor</th>
          <th>Staff</th>
          <th>Date</th>
          <th>Total Amount</th>
          <th>Action</th>
        </tr> 
      </thead>
      <tbody>
          <?php 
           if(isset($_POST['btnsearch'])){
            $field = $_POST['field'];
            $search = $_POST['search'];
            if($field != 'all'){
           $sql="SELECT * FROM purchase_master WHERE `$field` LIKE '%$search%'";
           $pms = Purchase_master::find_by_query($sql);
            }
            else{
              $pms = Purchase_master::find_all();
            }
          }
          else{
          $pms = Purchase_master::find_all();
          }
         foreach($pms as $pm){
         ?>
        <tr data-toggle="collapse" id="table<?php echo $pm->id; ?>" data-target=".table<?php echo $pm->id; ?>">
          <td><?php echo $pm->id; ?></td>
          <td><?php $vendor = Vendor::find_by_id($pm->vendor_id);
          echo $vendor->name; ?></td>  
          <td><?php  $staff = User::find_by_id($pm->staff_id);
           echo "$staff->first_name $staff->last_name"; ?></td>
          <td><?php echo $pm->date; ?></td>
          <td> <?php 
         
          echo $pm->total_amount; ?></td>
          <td><button class="btn btn-default btn-sm">View Items</button></td>
        </tr>

        <tr class="collapse table<?php echo $pm->id; ?>">
          <td colspan="999">
            <div>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>id</th>
        
                    <th>Size</th>
                    <th>Color</th>
                                <th>Product</th>
                                <th>Category</th>
                    <th>Subcategory</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                      $sql = "SELECT * FROM purchase_child WHERE master_id = $pm->id ";
                      $pcs = Purchase_child::find_by_query($sql);
                      foreach($pcs as $pc){
                          
                    
                    ?>
                  <tr>
                    <td><?php echo $pc->id; ?></td>
                    <td><?php
              
                    $variant = Variant::find_by_id($pc->item_id);

                    echo $variant->size; ?></td>
                   <td><input type="color" value='<?php echo $variant->color; ?>'></td>
                    <td>     <?php
                     
                    $product = Product::find_by_id($variant->product_id);
                    
                    echo $product->name; ?></td>
                         <td>     <?php
                     
                     $category = Category::find_by_id($product->category);
                     
                     echo $category->name; ?></td>
                        <td>     <?php
                     
                     $subcategory = Subcategory::find_by_id($product->subcategory);
                     
                     echo $subcategory->name; ?></td>
                    <td><?php echo $pc->quantity; ?></td>
                    <td><?php echo $pc->rate; ?></td>
                  </tr>
                      <?php } ?>
                 
                </tbody>
              </table>
            </div>
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