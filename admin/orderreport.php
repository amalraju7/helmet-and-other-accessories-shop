<?php ob_start();
 require_once("includes/init.php"); ?>
<?php require_once("includes/functions.php"); ?>

<html>
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Hello</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>	
                <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
                
                
                <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> 
                <style>
                #example_wrapper{
                    margin:30px;
                }
                </style>
                
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script> 
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script> 
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script> 
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
                <script type="text/javascript">
	$(document).ready(function() 
	{ 
	    $('#example').DataTable( 
	    {             
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	        dom: 'Blfrtip',
            buttons: [      
                {
                    extend: 'excelHtml5',
                    title: '<?php echo "Mactanse: Order Report {$_POST['from']} - {$_POST['to']} " ?>',
                    text:'Download as Excel' 
                },
                {
                    extend: 'csvHtml5',
                    title: '<?php echo "Mactanse: Order Report {$_POST['from']} - {$_POST['to']} " ?>',                 
                    text: 'Download as CSV' 
                },
                {
                    extend: 'pdfHtml5',
                    title: '<?php echo "Mactanse: Order Report {$_POST['from']} - {$_POST['to']} " ?>',
                    className: 'btn_pdf',
                    text: 'Download as PDF' 
                },
	       ]	        
	    });
        
        $('.btn_pdf').attr("class","btn btn-success");

	} );
	</script>
        </head>
        <body>
        <?php
include("includes/navigation.php");
?>   
<br>
<?php
if(isset($_POST['submit'])){
// echo $_POST['from']."   ";
// echo $_POST['to'];
// $from = str_replace('-', '/', $_POST['from']);
// $to = str_replace('-', '/', $_POST['to']);
// $from = str_replace('/', '-', $_POST['from']);
// $to = str_replace('/', '-', $_POST['to']);
// $from =date("d-m-Y", strtotime($from) );
// $to=date("d-m-Y", strtotime($to) );
// $from = str_replace('-', '/', $from);
// $to = str_replace('-', '/', $to);
// echo "$from     $to";

$pms = Order_master::find_all();
$main = array();
foreach($pms as $pm){

    $from = $_POST['from'];
    $to = $_POST['to'];
    $date = str_replace('/', '-', $pm->date);
    $date = date('Y-m-d',strtotime($date));
   if($date >= $from && $date <= $to){
     $main[] = $pm->id;
   }
}
$main = implode(" OR master_id = ",$main);

}
?>
<h1>Order Report From <?php echo $from; ?> To <?php echo $to; ?> </h1>
                <table id="example" class="display nowrap mx-3">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Item</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>User Id</th>
                    <th>User Name</th>
                    <th>User Email</th>
                            <th>Quanity</th>
                            <th>Rate</th>
                            <th>Sub Total</th>
                            <th>Date</th>
                        </tr> </thead>
                        <tbody>
                            <?php
                        $sql = "SELECT  *  FROM `order_child` WHERE master_id = $main ";
                        $result = $database->query($sql);
                        $s=0;
                        while($row = mysqli_fetch_array($result)){
                          
                        $s++;


                        ?>
                        <tr>
                            <td><?php echo $s; ?></td>
                            <td><?php
                            $variant= Variant::find_by_id($row['item_id']);
                           
                            $product = Product::find_by_id($variant->product_id);
                            echo " $product->name";   ?></td>
                          
                            <td><?php echo "<input type='color' value='$variant->color'>";?></td>
                            <td><?php echo $variant->size;?></td>
                      
                                  <td><?php 
                         $om = Order_master::find_by_id($row['master_id']);
                         $u = User::find_by_id($om->cust_id);
                        echo $u->id;
                        
                        ?>

                        
                        
                        </td>
                        <td><?php echo "$u->first_name $u->last_name"; ?></td>
                        <td><?php echo $u->email; ?></td>
                        <td><?php 
                        
                        echo $row['quantity'];
                        
                        ?> </td>
                         <td><?php 
                        
                        echo $row['rate'];
                        
                        ?> </td>

<td><?php echo $row['quantity'] * $row['rate'];  ?></td>

                        <td><?php 
                       

                        echo $om->date;
                        
                        ?>
                    
                    
                    </td>

                        </tr>
                       <?php } ?>
                        
                    </tbody>
                    </table>
                      
                   
                    <script type="text/javascript">
$(document).ready(function() 
{ 
    $('#tableID').DataTable( 
    { 
        dom: 'Blfrtip',
    } );

} );
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
                    </body>

                    </html>