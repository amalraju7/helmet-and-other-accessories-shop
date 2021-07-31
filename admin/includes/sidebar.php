<nav style="position:fixed;height:100vh;"  class="col-md-2 d-none d-md-block sticky-left bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <?php if($session->user_role == "admin"){ ?>
			  <li class="nav-item">
                <a class="nav-link" href="users.php?role=admin">
                  <span data-feather="file"></span>
              Admin
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="users.php?role=staff">
                  <span data-feather="file"></span>
                Staff
                </a>
              </li>
              <?php } ?>
              <li class="nav-item">
                <a class="nav-link" href="users.php?role=customer">
                  <span data-feather="file"></span>
                Customer
                </a>
              </li>
             
				<li class="nav-item">
                <a class="nav-link" href="products.php">
                  <span data-feather="file"></span>
                  Products
                </a>
				</li>

        <li class="nav-item">
                <a class="nav-link" href="variants.php">
                  <span data-feather="file"></span>
                  Variants
                </a>
				</li>

				<li class="nav-item">
                <a class="nav-link" href="categories.php">
                  <span data-feather="file"></span>
                  Categories
                </a>
				</li>
				<li class="nav-item">
                <a class="nav-link" href="subcategories.php">
                  <span data-feather="file"></span>
                  Subcategories
                </a>
				</li>

        <li class="nav-item">
                <a class="nav-link" href="brands.php">
                  <span data-feather="file"></span>
                  Brand
                </a>
				</li>
        <li class="nav-item">
                <a class="nav-link" href="vendors.php">
                  <span data-feather="file"></span>
                  Vendor
                </a>
        </li>
        
        <li class="nav-item">

                <a class="nav-link" href="purchases.php">
                  <span data-feather="file"></span>
                  Purchases
                </a>
        </li>
        <li class="nav-item">

                <a class="nav-link" href="sales.php">
                  <span data-feather="file"></span>
                  Order
                </a>
				</li>
                

					 
            </ul>

            
          </div>
        </nav>