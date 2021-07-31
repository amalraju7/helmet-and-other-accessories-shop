<?php require_once("admin/includes/init.php"); ?>
<?php require_once("admin/includes/functions.php"); ?>
<?php 
$user_id = $session->user_id;

$om = new Order_master();
$om->cust_id=$user_id;
$om->date=date("d/m/Y");
$om->status = "Not yet dispatched ";
$om->expected = "Will be updated soon";

$om->save();
$om_id = mysqli_insert_id($database->connection);
$total = 0;
if(isset($_GET['status'])){
    $sql = "SELECT * FROM cart WHERE user_id = $user_id AND status = 'buy'  ";
}
else{


$sql = "SELECT * FROM cart WHERE user_id = $user_id AND status = 'cart' ";
}

$carts = Cart::find_by_query($sql);
foreach($carts as $cart){
$variant = Variant::find_by_id($cart->variant_id);
$variant->quantity = $variant->quantity - $cart->quantity;
$oc = new Order_child();
$oc->master_id = $om_id;
$oc->item_id = $variant->id;
$oc->quantity = $cart->quantity;
$oc->rate = $variant->selling_price;
$total = $total + ($oc->quantity * $oc->rate );
$variant->save();
$oc->save();
$cart->delete();
}
$om = Order_master::find_by_id($om_id);
$om->total_amount = $total;
$payment = new Payment();
$payment->master_id = $om_id;
$payment->status ="successfull";
$user = User::find_by_id($user_id);
$payment->card_id = $user->card_id;
$payment->address_id = $user->address_id;
$payment->tracking_id = "MAC".User::randompassword();
$track = $payment->tracking_id;
$om->save(); 
$payment->save();
?>



<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    
    <style type="text/css">
        .auto-style1 {
            width: 100%;
        }
        .auto-style4 {
            height: 80px;
        }
        .auto-style5 {
            width: 327px;
            height: 81px;
        }
        .auto-style6 {
            width: 785px;
            text-align: left;
        }
        .auto-style7 {
            width: 444px;
            height: 124px;
        }
        .auto-style8 {
            width: 61px;
            height: 70px;
        }
        .auto-style9 {
            width: 112px;
            height: 66px;
        }
        .auto-style10 {
            width: 88px;
            height: 74px;
        }
        .auto-style11 {
            width: 886px;
            text-align: center;
        }
        .auto-style12 {
            width: 173px;
        }
        .auto-style14 {
            width: 624px;
            height: 93px;
        }
        .auto-style15 {}
        .auto-style16 {
            width: 101px;
        }
        .auto-style17 {
            width: 990px;
        }
        .btn {
            position: absolute;
            border: 2px solid green;
            background-color: green;
            color: white;
            padding: 10px;
            text-decoration: none;
            bottom: 200px;
            left: 597px;
            width: 12rem;
        }

    </style>
</head>
<body onLoad="myFunction()">
    <form id="form1" runat="server">
    <div>
        <table class="auto-style1">
            <tr>
                <td class="auto-style4">
                    <table class="auto-style1">
                        <tr>
                            <td class="auto-style6">
                                <img alt="" class="auto-style7" src="Images/dp_hm_slider03.jpg" /></td>
                            <td style="text-align: right">
                                <img alt="" class="auto-style5" src="Images/payment-gateway-security.jpg" /></td>
                        </tr>
                    </table>
                </td>
                
            </tr>
            <tr>
                <td class="auto-style15" >
                    <asp:ScriptManager ID="ScriptManager1" runat="server"></asp:ScriptManager>
           
                      <fieldset><legend style="text-align: center; font-weight: 700">Payment Details</legend>
       
        <table class="auto-style1">
            <tr>
                <td class="auto-style29"></td>
                <td style="text-align: right" class="auto-style29">
                   
                   </td>
                <td class="auto-style29"></td>
            </tr>
            <tr>
                <td class="auto-style18"></td>
                <td class="auto-style18" style="text-align: center; color: #3399FF">Payment Success...</td>
                <td class="auto-style18"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <table class="auto-style1">
                        
                        <tr>
                            <td class="auto-style33">Date <?php echo date("d/m/Y"); ?></td>
                            <td class="auto-style34"></td>
                            <td class="auto-style35">
                                &nbsp;<asp:Label ID="lblDate" runat="server"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-style36">Amount : <?php echo $total ?></td>
                            <td class="auto-style37"></td>
                            <td class="auto-style38">
                                Rs. <?php echo $total ?><asp:Label ID="lblAmoubnt" runat="server"></asp:Label>
                                <strong>/-</strong></td>
                        </tr>
                        <tr>
                            <td class="auto-style36">Tracking ID : <?php echo  $track; ?> </td>
                            <td class="auto-style37"></td>
                            <td class="auto-style38">&nbsp; <asp:Label ID="lblTID" runat="server"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-style36">Tracking Website: <a href="https://www.bluedart.com/ ">Blue dart</a>     </td>
                            <td class="auto-style37"></td>
                            <td class="auto-style38">&nbsp; <asp:Label ID="lblTID" runat="server"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="auto-style21" style="text-align: center">
                                <asp:Button ID="Button1" runat="server" Text="Continue" Width="108px" OnClick="Button1_Click" style="font-weight: 700" />
                            </td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="auto-style39"></td>
                <td style="text-align: center" class="auto-style39">&nbsp;&nbsp;&nbsp;
                    <img alt="" class="auto-style24" src="Icons/1391813453_mastercard1.gif" />
                    <img alt="" class="auto-style24" src="Icons/1391813456_visa2.gif" />
                    <img alt="" class="auto-style24" src="Icons/1391813466_westernunion.gif" />
                    <img alt="" class="auto-style24" src="Icons/1391813469_cirrus1.gif" />
                    <img alt="" class="auto-style24" src="Icons/1391813513_visa1.gif" />
                    <a class="btn" href="index.php">Continue Shopping</a>
                </td>
                <td class="auto-style39"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        
    </fieldset></div>
                </td>
            </tr>
            <tr>
               
                <td class="auto-style4">
                    <table align="center">
                        <tr>
                            <td class="auto-style12">
                                <img alt="" class="auto-style8" src="Images/secure.jpg" /><img alt="" class="auto-style9" src="Images/firstdataglobal_cardinal_centinel_3d-secure_b909dac69bbd832054c1bf467e389c8f_verified_by_visa_1.gif" /></td>
                            <td class="auto-style11">
                                <img alt="" class="auto-style14" src="Images/seq.JPG" /></td>
                            <td style="text-align: right">
                                <img alt="" class="auto-style10" src="Images/ImgSml_PaymentGateway.jpg" /></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    </form>
    <script>
// function myFunction() {
//   setTimeout(function(){ window.location.href="index.php"; }, 20000);
// }
</script>
</body>
</html>
