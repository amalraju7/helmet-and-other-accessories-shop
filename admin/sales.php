<?php
include("includes/header.php");
?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php
include("includes/navigation.php");
?>
<?php
if(isset($_POST['drop_submit'])){
  $om = Order_master::find_by_id($_GET['id']);

  $om->status = $_POST['status'];
  $om->expected = $_POST['expected'];
  $om->save();
}
?>

<?php
$sql = "SELECT * FROM order_master WHERE total_amount = 0 ";
$oms = Order_master::find_by_query($sql);
foreach($oms as $om){
  $om->delete();
}
$sql = "SELECT * FROM order_child WHERE rate = 0 ";
$ocs = Order_child::find_by_query($sql);
foreach($ocs as $oc){
  $om = Order_master::find_by_id($oc->master_id);
  $oc->delete();
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
		
			
				<h1> Orders :</h1><form method="POST"  class="form-inline">
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
          <th>Customer</th>
          <th>Date</th>
          <th>Total Amount</th>
          <th>Expected</th>
          <th>Order Status</th>
          <th>Payment Id</th>
                   <th>Tracking Id</th>
                  <th>Status</th>
                  <th>Card</th>
                  <th>Address</th>
          <th>Action</th>
        </tr> 
      </thead>
      <tbody>
          <?php 
         if(isset($_POST['btnsearch'])){
           $field = $_POST['field'];
           $search = $_POST['search'];
           if($field != 'all'){
          $sql="SELECT * FROM order_master WHERE `$field` LIKE '%$search%'";
          $oms = Order_master::find_by_query($sql);
           }
           else{
            $oms = Order_master::find_all();
           }
         }
         else{
          $oms = Order_master::find_all();
         }
         foreach($oms as $om){
         ?>
        <tr data-toggle="collapse" id="table<?php echo $om->id; ?>" data-target=".table<?php echo $om->id; ?>">
          <td><?php echo $om->id; ?></td>
   
          <td><?php  $cust = User::find_by_id($om->cust_id);
           echo "$cust->first_name $cust->last_name"; ?></td>
          <td><?php echo $om->date; ?></td>
          <td> <?php 
     
         echo $om->total_amount;
           ?></td>
            <td> <?php 
     
         echo $om->expected;
           ?></td>
                 <td> <?php 
     
         echo $om->status;
           ?></td>
          <td><?php $sql=" SELECT * FROM payment WHERE master_id = {$om->id} ";
     
          $payment = Payment::find_by_query($sql);
          $payment = array_shift($payment);
          echo $payment->id  ?></td>
          <td><?php echo $payment->tracking_id; ?></td>
          <td><?php echo $payment->status; ?></td>
          <td><?php echo $payment->card_id; ?></td>
          <td><?php echo $payment->address_id; ?></td>
          <td><button class="btn btn-default btn-sm">View Items</button>					  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <form action="sales.php?id=<?php echo $om->id; ?>"  method="post">
 
						<label for="quantity">Expected</label>
						<input type="text" name="expected" class="form-control" placeholder="Selling Price" value="<?php 
         echo $om->expected; ?>"  >
					
			
            
                <label for="product_subcategory_id">Order Status: </label>
                <select class="form-control" name="status" id="product_category_id">
                
             <option value="Packed">Packed</option>
             <option value="Shipped">Shipped</option> 
             <option value="Delivered">Delivered</option> 
                </select><br> 
      
						<button name="drop_submit" class="btn btn-success">Update</button>
					</form>
  </div>
</div></td>
        </tr>

        <tr class="collapse table<?php echo $om->id; ?>">
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
                      $sql = "SELECT * FROM order_child WHERE master_id = $om->id ";
                      $ocs = Order_child::find_by_query($sql);
                      foreach($ocs as $oc){
                          
                    
                    ?>
                  <tr>
                    <td><?php echo $oc->id; ?></td>
                    <td><?php
              
                    $variant = Variant::find_by_id($oc->item_id);

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
                    <td><?php echo $oc->quantity; ?></td>
                    <td><?php echo $oc->rate; ?></td>
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