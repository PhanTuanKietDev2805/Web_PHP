<?php
  if(isset($_GET['login'])){
    $dangxuat = $_GET['login'];
    }else{
      $dangxuat = '';
    }
  if($dangxuat=='dangxuat'){
    unset($_SESSION['dangnhap_home']);
    header('Location:index.php');
  }
?>


<div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="index.php?quanly=timkiem" class="site-block-top-search" method="POST">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" placeholder="Search" name="stext">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="index.php" class="js-logo-clone">Shoppers</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              
              <div class="site-top-icons">
                
                <ul>
                <li>             
                    
                    
                    <?php 
                    if (isset($_SESSION['dangnhap_home'])){
                  ?>
                   <a href="?quanly=xemdonhang" class="site-cart">
                     Your Order
                    </a>
                         Hello:  <?php echo $_SESSION['dangnhap_home'];?>
                          
                        / <span><a href="?login=dangxuat">Logout</a></span>
                        </li> 
                      <a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']?>" class="site-cart">
                      <a href="index.php?quanly=giohang" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>   
                      
                    </a>

                    
                </ul>
                        
                  <?php  
                    }else{
                  ?>
                      
                          <span><a href="login.php">Login</a> <span> / </span> <a href="register.php"> Sign In</a></span>
                          </li> 
                      <a href="index.php?quanly=giohang" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>   
                    </a>
                   
                </ul>
                  
                  <?php  
                    }
                  ?>    
                  
                    
                  
              </div> 
            </div>

          </div>
        </div>
      </div> 

