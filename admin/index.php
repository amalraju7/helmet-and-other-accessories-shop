<?php
include("includes/header.php");
?>

<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <base target="_self">

  <meta name="description" content="A Bootstrap 4 admin dashboard theme that will get you started. The sidebar toggles off-canvas on smaller screens. This example also include large stat blocks, modal and cards. The top navbar is controlled by a separate hamburger toggle button."
  />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="google" value="notranslate">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Order',  'Purchase'],
          <?php 
                 $sqll="SELECT MAX(date),MIN(date) FROM `order_master` ";
                 $resultt = $database->query($sqll);
                 $sql="SELECT MAX(date),MIN(date) FROM `purchase_master` ";
                 $result = $database->query($sql);
                
                 while($row = mysqli_fetch_array($result)){
                $date1=$row;
                 }
                while($row = mysqli_fetch_array($resultt)){
         $date2 = $row;
                }
              
              
                if($date1[0] > $date2[1]){
                  $date[0]=$date1[0];
                }
                else{
                 $date[0]=$date2[0];
                }
     
                if($date1[1] < $date2[1]){
                 $date[1]=$date1[1];
               }
               else{
                $date[1]=$date2[1];
               } 
               $date[0] =str_replace('/','-',$date[0]);
               $date[0] = strtotime("+1 day", strtotime($date[0]));
               $date[0] = date("d/m/Y", $date[0]);
             
     


            $sql = "SELECT SUM(total_amount),date FROM purchase_master GROUP BY date";
            $result = $database->query($sql);
            
          
            while($row = mysqli_fetch_array($result)){
              $sql = "SELECT SUM(total_amount) FROM order_master WHERE date = '{$row[1]}'";
              $res =  $database->query($sql);
              while($roww=mysqli_fetch_array($res)){
            
            ?>

          ['<?php echo $row[1];?>', <?php if(isset($roww[0])){
            echo $roww[0];
          }
          else{
            echo 0;
          }
            ?> 
            ,  <?php if(isset($row[0])){
            echo $row[0];
          }
          else{
            echo 0;
          }
            ?> ],
            <?php } } ?>
        
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: ',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

  

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>







  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Admin',     <?php
                $sql = "SELECT * FROM users where user_type='admin'";
                $user = User::find_by_query($sql);
                echo count($user);
                ?>],
          ['Staff',      <?php
                $sql = "SELECT * FROM users where user_type='staff'";
                $user = User::find_by_query($sql);
                echo count($user);
                ?>],
          ['Customer',  <?php
                $sql = "SELECT * FROM users where user_type='customer'";
                $user = User::find_by_query($sql);
                echo count($user);
                ?>],
       
        ]);

        var options = {
          title: 'Users',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

  <link rel="shortcut icon" href="/images/cp_ico.png">


  <!--stylesheets / link tags loaded here-->


  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />


  <style type="text/css">

    /* workaround modal-open padding issue */
    
    body.modal-open {
      padding-right: 0 !important;
    }
    
    /*
 * Off Canvas at medium breakpoint
 * --------------------------------------------------
 */
    
    @media screen and (max-width: 48em) {
      .row-offcanvas {
        position: relative;
        -webkit-transition: all 0.25s ease-out;
        -moz-transition: all 0.25s ease-out;
        transition: all 0.25s ease-out;
      }
      .row-offcanvas-left .sidebar-offcanvas {
        left: -33%;
      }
      .row-offcanvas-left.active {
        left: 33%;
        margin-left: -6px;
      }
      .sidebar-offcanvas {
        position: absolute;
        top: 0;
        width: 33%;
        height: 100%;
      }
    }
    /*
 * Off Canvas wider at sm breakpoint
 * --------------------------------------------------
 */
    
    @media screen and (max-width: 34em) {
      .row-offcanvas-left .sidebar-offcanvas {
        left: -45%;
      }
      .row-offcanvas-left.active {
        left: 45%;
        margin-left: -6px;
      }
      .sidebar-offcanvas {
        width: 45%;
      }
    }
    
    .card {
      overflow: hidden;
    }
    
    .card-block .rotate {
      z-index: 8;
      float: right;
      height: 100%;
    }
    
    .card-block .rotate i {
      color: rgba(20, 20, 20, 0.15);
      position: absolute;
      left: 0;
      left: auto;
      right: -10px;
      bottom: 0;
      display: block;
      -webkit-transform: rotate(-44deg);
      -moz-transform: rotate(-44deg);
      -o-transform: rotate(-44deg);
      -ms-transform: rotate(-44deg);
      transform: rotate(-44deg);
    }
    .rowww{
        display:grid !important;
        grid-template-columns:repeat(4,200px);
        grid-gap:20px;
    }
  </style>

</head>

<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php
include("includes/navigation.php");
?>

<div class="container-fluid">
<div class="row ">
<?php include("includes/sidebar.php"); ?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="rowww d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="card card-inverse card-success">
              <div class="card-block bg-success">
                <div class="rotate">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Users</h6>
                <h1 class="display-1"><?php
                $user = User::find_all();
                echo count($user);
                ?> </h1>
              </div>
            </div>
            <div class="card card-inverse card-success">
              <div class="card-block bg-success">
                <div class="rotate">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Admin</h6>
                <h1 class="display-1"><?php
                $sql = "SELECT * FROM users where user_type='admin'";
                $user = User::find_by_query($sql);
                echo count($user);
                ?> </h1>
              </div>
            </div>
            <div class="card card-inverse card-success">
              <div class="card-block bg-success">
                <div class="rotate">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Staff</h6>
                <h1 class="display-1"><?php
                $sql = "SELECT * FROM users where user_type='staff'";
                $user = User::find_by_query($sql);
                echo count($user);
                ?></h1>
              </div>
            </div>
            <div class="card card-inverse card-success">
              <div class="card-block bg-success">
                <div class="rotate">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Customers</h6>
                <h1 class="display-1"><?php
                $sql = "SELECT * FROM users where user_type='customer'";
                $user = User::find_by_query($sql);
                echo count($user);
                ?></h1>
              </div>
            </div>
            <div class="card card-inverse card-danger">
              <div class="card-block bg-danger">
                <div class="rotate">
                  <i class="fa fa-list fa-4x"></i>
                </div>
                <h6 class="text-uppercase">Product</h6>
                <h1 class="display-1"><?php
                $user = Product::find_all();
                echo count($user);
                ?></h1>
              </div>
            </div>
            <div class="card card-inverse card-danger">
              <div class="card-block bg-danger">
                <div class="rotate">
                  <i class="fa fa-list fa-4x"></i>
                </div>
                <h6 class="text-uppercase">Variants</h6>
                <h1 class="display-1"><?php
                $user = Variant::find_all();
                echo count($user);
                ?></h1>
              </div>
            </div>
            <div class="card card-inverse card-danger">
              <div class="card-block bg-danger">
                <div class="rotate">
                  <i class="fa fa-list fa-4x"></i>
                </div>
                <h6 class="text-uppercase">Subcategories</h6>
                <h1 class="display-1"><?php
                $user = Subcategory::find_all();
                echo count($user);
                ?></h1>
              </div>
            </div>
            <div class="card card-inverse card-danger">
              <div class="card-block bg-danger">
                <div class="rotate">
                  <i class="fa fa-list fa-4x"></i>
                </div>
                <h6 class="text-uppercase">Categories</h6>
                <h1 class="display-1"><?php
                $user = Category::find_all();
                echo count($user);
                ?></h1>
              </div>
            </div>
            <div class="card card-inverse card-warning">
              <div class="card-block bg-warning">
                <div class="rotate">
                  <i class="fa fa-list fa-4x"></i>
                </div>
                <h6 class="text-uppercase">Brand</h6>
                <h1 class="display-1"><?php
                $user = Brand::find_all();
                echo count($user);
                ?></h1>
              </div>
            </div>
            <div class="card card-inverse card-warning">
              <div class="card-block bg-warning">
                <div class="rotate">
                  <i class="fa fa-list fa-4x"></i>
                </div>
                <h6 class="text-uppercase">Vendor</h6>
                <h1 class="display-1"><?php
                $user = Vendor::find_all();
                echo count($user);
                ?></h1>
              </div>
            </div>
            <div class="card card-inverse card-warning">
              <div class="card-block bg-warning">
                <div class="rotate">
                  <i class="fa fa-shopping-cart fa-4x"></i>
                </div>
                <h6 class="text-uppercase">Order</h6>
                <h1 class="display-1"><?php
                $user = Order_master::find_all();
                echo count($user);
                ?></h1>
              </div>
            </div>
            <div class="card card-inverse card-warning">
              <div class="card-block bg-warning">
                <div class="rotate">
                  <i class="fa fa-shopping-cart fa-4x"></i>
                </div>
                <h6 class="text-uppercase">Purchase</h6>
                <h1 class="display-1"><?php
                $user = Purchase_master::find_all();
                echo count($user);
                ?></h1>
              </div>
            </div>
<?php
       
          ?>
      

       
    </div>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  

  </main>
</div>
</div>

    <?php
include("includes/footer.php");
?>