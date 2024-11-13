<?php
  session_start();
  include_once('C:/xampp/htdocs/web/db/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Shoppers </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <?php
          include("include/topbar.php");
          include("include/menu.php");
          if(isset($_GET['quanly']))
          {
            $tam = $_GET['quanly'];
          }
          else
          {
            $tam = "";
          }
          if($tam == 'danhmuc')
          { 
            include("include/danhmuc.php");
          }
          else if ($tam == 'sanpham')
          {
            include("include/sanpham.php");
          }
          else if ($tam == 'chitietsp')
          {
            
            include("include/chitietsp.php");
          }
          else if($tam == 'giohang')
          {
            include("include/giohang.php");
          }
          else if($tam == 'about')
          {
            include("include/about.php");
          }
          else if ($tam == 'timkiem')
          {
            include("include/timkiem.php");
          }
          else if ($tam == 'locgia')
          {
            include("include/locgia.php");
          }
          else if ($tam == 'muahang')
          {
            include("include/checkout.php");
          }
          else if ($tam == 'xemdonhang')
          {
            include("include/xemdonhang.php");
          }
          else if ($tam == 'chitietdonhang')
          {
            include("include/chitietdonhang.php");
          }
          else if ($tam == 'thanhcong')
          {
            include("include/thankyou.php");
          }
          else
          {
            include("include/slider.php");
            include("include/home.php");
          }
          include("include/footer.php");
      ?>  

      
    </header>

    

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>