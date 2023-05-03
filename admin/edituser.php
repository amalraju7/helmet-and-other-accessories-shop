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
      if(isset($_POST['submit'])){

        $user = User::find_by_id($_GET['id']);
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
         $user->email = $_POST['email'];
         if(!empty($_POST['password'])){
            $user->password = $_POST['password'];
         }
        
        
       
         $user->user_type = $_POST['user_type'];

        $role = $user->user_type;
      
        if(empty($address->id)){
            $address = new Address();
        }
        else{
         $address = Address::find_by_id($user->address_id);
        }
        
         $address->user_id = $_GET['id'];
         
        $address->address_fname =  $_POST['first_name'];
        $address->address_lname =  $_POST['last_name'];
         $address->phone_no = $_POST['phone_no'];
         $address->house = $_POST['house'];
         $address->city = $_POST['city'];
         $address->district = $_POST['district'];
         $address->state = $_POST['state'];
         $address->pin = $_POST['pin'];

     
         if(!preg_match("/^[A-Za-z]+$/",$user->first_name)){
            $session->message = "Invalid First name use alphabets only";
            
        }
        else if(!preg_match("/^[A-Za-z]+$/",$user->last_name)){
            $session->message = "Invalid Last name use alphabets only";
            
        }

        else if(!filter_var($user->email, FILTER_VALIDATE_EMAIL)){
            $session->message = "Invalid  Email Address";
            
        }
     
        else if(!preg_match("/^\d{10}$/",$address->phone_no)){
            $session->message = "Please enter correct phone number";
            
        }
        else if(!preg_match("/^\d{6}$/",$address->pin)){
            $session->message = "Please enter correct pin code";
            
        }
        else if(!preg_match("/^[A-Za-z .]+$/",$address->city)){
            $session->message = "Invalid City";
            
        }
        else if(!preg_match("/^[A-Za-z .]+$/",$address->district)){
            $session->message = "Invalid District";
            
        }
        else if(!preg_match("/^[A-Za-z .]+$/",$address->state)){
            $session->message = "Invalid State";
            
        }
       

        else{
            $us = User::find_all();
            $select = User::find_by_id($_GET['id']);
            foreach($us as $u){
                if($user->email == $u->email)
                {
                    if(!($select->email == $u->email)){
                    $flag=1;
                    }
                }
            }
            if($flag==1){
                $session->message = "Email Already exists";
            }
            else{
                $address->save();
               $aid = mysqli_insert_id($database->connection);
               if(empty($address->id)){
                $aid = mysqli_insert_id($database->connection);
                $user->address_id = $aid;
            } 
            if(!empty($_POST['password'])){
                $user->password = password_hash($user->password, PASSWORD_DEFAULT);
             }
            
             $user->set_file($_FILES['user_image']);
             $user->save_data_and_image();
            
   
          
        
         redirect("users.php?role=$role");
     
        }
    }

      }
      
      ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit User</h1>
      				<h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name; 						 ?> 						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
          <h4 class="bg-danger"><?php echo $session->message; ?></h4>
			<div id="admin-index-form">
		
                <?php 
                $id = $_GET['id'];
                $user = User::find_by_id($id);

           
                $address = Address::find_by_id($user->address_id);

      


                ?>
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
                <div class="form-group">
                <label for="filename_id">User Image : </label>
                <a href="#" class="thumbnail"><img src="<?php echo $user->picture_path(); ?>" alt=""></a>
                <input  type="file" name="user_image" id="filename_id">
				</div>
				<label for="first_name_id">First Name : </label>
				
					 <input required type="text" id="first_name_id" value="<?php echo $user->first_name; ?>" name="first_name" class="form-control" ><br>
				
                     <label for="last_name_id">Last Name : </label>
                     
				
                <input required type="text" id="last_name_id" value="<?php echo $user->last_name; ?>" name="last_name" class="form-control" ><br>

                <label for="email_id">Email : </label>
				
					 <input required type="text" value="<?php echo $user->email; ?>" id="email_id" name="email" class="form-control" ><br>

                     <label for="password_id">Password : </label>
				
					 <input  type="password" id="password_id" name="password"   class="form-control" ><br>

                     <label for="phone_no_id">Phone Number : </label>
				
                <input required type="text" id="phone_no_id" value="<?php echo empty($address->id) ? "User not entered" :  $address->phone_no; ?>" name="phone_no" class="form-control" ><br>

                <label for="pin_id">PIN code: </label>
				
                <input required type="text" id="pin_id" name="pin"  value="<?php echo empty($address->id) ? "User not entered" :  $address->pin; ?>" class="form-control" ><br>

                <label for="house_id"> Flat, House no., Building, Company, Apartment: </label>
				
                <input required type="text" id="house_id" value="<?php echo empty($address->id) ? "User not entered" :  $address->house; ?>" name="house" class="form-control" ><br>
                <label for="city_id"> Town/City: </label>
				
                <input required type="text" id="city_id" value="<?php echo empty($address->id) ? "User not entered" :  $address->city; ?>" name="city" class="form-control" ><br>
                <label for="district_id"> District </label>

                <input required type="text" id="district_id" value="<?php echo empty($address->id) ? "User not entered" :  $address->district; ?>" name="district" class="form-control" ><br>
                <label for="state_id"> State: </label>
				
                <input required type="text" id="state_id" name="state" class="form-control" value="<?php echo empty($address->id) ? "User not entered" :  $address->state; ?>" ><br>
					
					</select><br> 

					<label for="user_type_id ">Usertype: </label>
					<select name="user_type" class="form-control" id="user_type_id" value="<?php echo $user->user_type; ?>">
					<option value="staff" default >Staff</option>
                    <option value="admin" default >Admin</option>
                    <option value="customer" default >Customer</option>
					</select><br> 

                    


				
				
					 
					 
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