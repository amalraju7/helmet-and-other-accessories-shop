<?php require_once("admin/includes/init.php"); ?>
<?php require_once("admin/includes/functions.php"); ?>
<?php if(isset($_POST['submit'])){
    $id = $_GET['id'];
  $address =  Address::find_by_id($id);
  
     
      $address->address_fname = $_POST['fname'];

      $address->user_id = $session->user_id;
      $address->address_lname = $_POST['lname'];
      $address->house = $_POST['house'];
      $address->city = $_POST['city'];
      $address->district = $_POST['district'];
      $address->state = $_POST['state'];
      $address->pin = $_POST['pincode'];
      $address->phone_no = $_POST['phone_no'];
      $address->save();
  if(isset($_GET['page']))
  {
 
    redirect("viewaddress.php");
  }
  else if(isset($_GET['bid'])){
    $bid = $_GET['bid'];
    redirect("payment.php?bid=$bid");

  }
  else{
     redirect("payment.php");
  }



}?>
<html>
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Hello</title>
            <link rel="stylesheet" href="css/address.css">
           

       
    </head>
    <body>
<?php if(isset($_GET['id'])){
    $id = $_GET['id'];
    $address = Address::find_by_id($id);

} ?>
            <form class="container" method="POST" >
                    <h1>Shipping</h1>
                    <p>Please enter your shipping details.</p>
                    <hr />
                    <div class="form">
                      
                    <div class="fields fields--2">
                      <label class="field">
                        <span class="field__label" for="firstname">First name</span>
                        <input name="fname" value="<?php echo $address->address_fname; ?>" class="field__input" type="text" id="firstname"  />
                      </label>
                      <label class="field">
                        <span class="field__label" for="lastname">Last name</span>
                        <input name="lname" value="<?php echo $address->address_lname; ?>"  class="field__input" type="text" id="lastname"  />
                      </label>
                    </div>
                    <label class="field">
                      <span class="field__label" for="address">Flat, House no., Building, Company, Apartment:</span>
                      <input name="house" value="<?php echo $address->house; ?>"  class="field__input" type="text" id="address" />
                    </label>
                    <label class="field">
                      <span class="field__label" for="address">Phone Number</span>
                      <input name="phone_no" value="<?php echo $address->phone_no; ?>"  class="field__input" type="text" id="address" />
                    </label>
                
                          <label class="field">
                                <span class="field__label" for="address">District:</span>
                                <input  value="<?php echo $address->district; ?>"  name="district" class="field__input" type="text" id="address" />
                              </label>
                    <!-- <label class="field"> -->
                      <!-- <span class="field__label" for="country">Country</span>
                      <select class="field__input" id="country">
                        <option value=""></option>
                        <option value="unitedstates">United States</option>
                      </select> -->
                    </label>
                    <div class="fields fields--3">
                      <label class="field">
                        <span name="pincode" class="field__label" for="pincode">Pin code</span>
                        <input name="pincode"  value="<?php echo $address->pin; ?>"  class="field__input" type="text" id="pincode" />
                      </label>
                      <label class="field">
                        <span class="field__label" for="city">Town/City</span>
                        <input name="city"  value="<?php echo $address->city; ?>"  class="field__input" type="text" id="city" />
                      </label>
                      <label class="field">
                        <span class="field__label" for="state">State</span>
                        <select class="field__input" name="state" id="state">
                                <option value="<?php echo $address->state; ?>"   selected > <?php echo $address->state; ?></option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Puducherry">Puducherry</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                        </select>
                      </label>
                    </div>
                    </div>
                    <hr>
                    <button class="button" name="submit">Continue</button>
</form>
                  </body>
                  </html>