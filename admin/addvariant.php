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

    <?php 
    
    if(isset($_GET['values'])){
     
      $values = explode(',',$_GET['values']);
      $csize = $values[0];
      
      $ccolor = "#".$values[1];
      $id = $values[2];
      
    


    }
    else{
     
      if(isset($_POST['submit'])){
       
        $selling_Price= array($_POST['xs_Selling_Price'],$_POST['s_Selling_Price'],$_POST['m_Selling_Price'],$_POST['l_Selling_Price'],$_POST['xl_Selling_Price']);
        $buying_Price = array($_POST['xs_Buying_Price'],$_POST['s_Buying_Price'],$_POST['m_Buying_Price'],$_POST['l_Buying_Price'],$_POST['xl_Buying_Price']);
        $sizes = array('XS' , 'S' , 'M' , 'L' , 'XL');
        foreach($sizes as $index => $size){


      $sql = "SELECT * FROM `variant` WHERE `product_id` = '{$_GET['id']}' AND `color` = '{$_POST['color']}' AND `size` = '$size' ";
        $result = Variant::find_by_query($sql);
        if($result)
        {
  die("This variant is already present");
        }

        else{
          $variant = new Variant();
          $variant->quantity = 0;
          unset($variant->images);
          $variant->save_multiple_images($_FILES['files']);
        }
        $variant->product_id = $_GET['id'];
        $variant->color =$_POST['color'];
        $variant->selling_price = $selling_Price[$index]; 
         $variant->buying_price = $buying_Price[$index];
        $variant->size = $size;
      
        
     
        $variant->save();
        redirect("variants.php");
      }
    }

    }

		 ?>

		

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Purchase</h1>
            <!-- <h6>Howdy  | Your role is</h6> -->
          </div>
		
			<div id="admin-index-form">
		
		
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
        <label for="product_title_id">Product : </label>
				
        <input required type="text" id="product_title_id" name="product" class="form-control"  <?php
         $product = Product::find_by_id($_GET['id']);
         echo "value='{$product->name}'";
         echo "disabled";
         ?>><br>
      
					
					</select><br>
				
           <label for="product_title_id">Color : </label>
				
        
        
        <input required type="color" id="product_title_id" name="color"  <?php echo (isset($_GET['values']))?"disabled":" " ?> value="<?php echo $ccolor; ?>" class="form-control" ><br>
        
        <?php
        if(isset($_GET['values'])){  
          ?>
        <label for="product_title_id">Size : </label>

        
				
        <select  id="product_title_id" name="size" class="form-control" <?php echo (isset($_GET['values']))?"disabled":" " ?> >
        <?php $sizes = array('XS' , 'S' , 'M' , 'L' , 'XL');
         foreach($sizes as $size){
           $k = ($size == $csize) ? "selected":" ";
           
          echo "<option value='$size' $k > $size </option>";
        }

        ?>
          



        </select>

        <?php
        }
        else{
         
        

        ?>



  
    <div class="form-row">
    <div class="col-md-2 mb-3 mx-3">
      <label for="validationCustom01">XS:</label>
      <input required type="number" name="xs_Buying_Price" class="form-control" id="validationCustom01" placeholder=" Buying Price"  >
   
    </div>
    <div class="col-md-2 mb-3 mx-3">
      <label for="validationCustom02">S:</label>
      <input required type="number" name="s_Buying_Price" class="form-control" id="validationCustom02" placeholder="Buying Price"  >
  
    </div>
    <div class="col-md-2 mb-3 mx-3">
      <label for="validationCustom02">M:</label>
      <input required type="number" name="m_Buying_Price" class="form-control" id="validationCustom02" placeholder=" Buying Price"  >
  
    </div>
    <div class="col-md-2 mb-3 mx-3">
      <label for="validationCustom02">L:</label>
      <input required type="number" name="l_Buying_Price" class="form-control" id="validationCustom02" placeholder=" Buying Price"  >
  
    </div>
    <div class="col-md-2 mb-3 ">
      <label for="validationCustom02">XL:</label>
      <input required type="number" name="xl_Buying_Price" class="form-control" id="validationCustom02" placeholder="Buying Price"  >
  
    </div>
    
    </div>


     
    <div class="form-row">
    <div class="col-md-2 mb-3 mx-3">
      <label for="validationCustom01">XS:</label>
      <input required type="number" name="xs_Selling_Price" class="form-control" id="validationCustom01" placeholder=" Selling Price"  >
   
    </div>
    <div class="col-md-2 mb-3 mx-3">
      <label for="validationCustom02">S:</label>
      <input required type="number" name="s_Selling_Price" class="form-control" id="validationCustom02" placeholder="Selling Price"  >
  
    </div>
    <div class="col-md-2 mb-3 mx-3">
      <label for="validationCustom02">M:</label>
      <input required type="number" name="m_Selling_Price" class="form-control" id="validationCustom02" placeholder=" Selling Price"  >
  
    </div>
    <div class="col-md-2 mb-3 mx-3">
      <label for="validationCustom02">L:</label>
      <input required type="number" name="l_Selling_Price" class="form-control" id="validationCustom02" placeholder=" Selling Price"  >
  
    </div>
    <div class="col-md-2 mb-3 ">
      <label for="validationCustom02">XL:</label>
      <input required type="number" name="xl_Selling_Price" class="form-control" id="validationCustom02" placeholder="Selling Price"  >
  
    </div>
    
    </div>



        <?php } ?>
					
        <label for="product_title_id" >Upload Images : </label>
				
        <input required type="file" id="product_title_id" name="files[]" class="form-control" <?php echo (isset($_GET['values']))?"disabled":" " ?> multiple ><br>
     
        
					 
					 <button name="submit" type="submit" class="btn btn-primary">Submit</button>
				</div>
				</form>
				
				
				
			</div>
        
          </div>
        </main>
      </div>
    </div>


    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ey5ln3e6qq2sq6u5ka28g3yxtbiyj11zs8l6qyfegao3c0su"></script>

<script>tinymce.init({ selector:'textarea' });</script>
    <?php
include("includes/footer.php");
?>