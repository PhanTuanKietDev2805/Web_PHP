<?php
	include('../db/connect.php');
?>
<?php
	session_start();
	if(!isset($_SESSION['dangnhap'])){
		header('Location: index.php');
	} 
	if(isset($_GET['login'])){
 	$dangxuat = $_GET['login'];
	 }else{
	 	$dangxuat = '';
	 }
	 if($dangxuat=='dangxuat'){
	 	session_destroy();
	 	header('Location:../index.php');
	 }
?>
<?php
    if(isset($_POST['themsanpham'])){
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh1 = $_FILES['hinhanh1']['name'];
        $hinhanh2 = $_FILES['hinhanh2']['name'];
		$soluong = $_POST['soluong'];
		$gia = $_POST['giasanpham'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
        $hot = $_POST['sanpham_hot'];
        $tinhtrang = $_POST['tinhtrang'];
        $size = $_POST['size'];
		$path = '../images/';
		
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $hinhanh_tmp1 = $_FILES['hinhanh1']['tmp_name'];
        $hinhanh_tmp2 = $_FILES['hinhanh2']['tmp_name'];
		$sql_insert_product = mysqli_query($con,"INSERT INTO tbl_sanpham(sanpham_name,sanpham_chitiet,sanpham_gia,sanpham_soluong,sanpham_image,sanpham_image1,sanpham_image2,category_id, tinhtrang, sanpham_hot, sanpham_size) values ('$tensanpham','$chitiet','$gia','$soluong','$hinhanh','$hinhanh1','$hinhanh2','$danhmuc', '1', '$hot', '$size')");
		move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        move_uploaded_file($hinhanh_tmp1,$path.$hinhanh1);
        move_uploaded_file($hinhanh_tmp2,$path.$hinhanh2);
        header('Location:sanpham.php');
	}
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                <li class="menu-title">Hello <?php echo $_SESSION['dangnhap'] ?></li>
                    <li >
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Home</a>
                    </li>
                   
                    <li >
                    <a href="danhmuc.php"><i class="menu-icon fa fa-table"></i>Category Manage</a>
                    </li>
                    <li class="active">
                        <a href="sanpham.php" > <i class="menu-icon fa fa-tasks"></i>Product Manage</a>
                    </li>
                    <li >
                        <a href="quanlyuser.php" > <i class="menu-icon fa fa-user"></i>User Manage</a>
                    </li>
                    <li >
                        <a href="quanlydonhang.php" > <i class="menu-icon fa fa-shopping-cart"></i>Order Manage</a>
                    </li>





                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
        <div id="right-panel" class="right-panel">
            <!-- Header-->
            <header id="header" class="header">
                <div class="top-left">
                    <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">Shoppers</a>
                        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <div class="top-right">
                    <div class="header-menu">
                        <div class="header-left">
                            <button class="search-trigger"><i class="fa fa-search"></i></button>
                            <div class="form-inline">
                                <form class="search-form">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                    <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                                </form>
                            </div>


                    

                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                            </a>

                            <div class="user-menu dropdown-menu">

                                <a class="nav-link" href="?login=dangxuat"><i class="fa fa-power -off"></i>Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                <form method="post" enctype="multipart/form-data" role="form">
                    <div class="col-md-7">
                        <div class="form-group">
                        <label>Product Name</label>
					<input type="text" class="form-control" name="tensanpham" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                        <label>Price</label>
					<input type="text" class="form-control" name="giasanpham" placeholder="Price">
                        </div>
                        <div class="form-group">
                        <label>Details</label>
					<textarea type="text" class="form-control" name="chitiet"></textarea>
                        </div>

                        <div class="form-group">
                        <label>Product Image</label>
					<input type="file" name="hinhanh">
                        </div>

                        <div class="form-group">
                        <label>Details Image 1</label>
					<input type="file" name="hinhanh1">
                        </div>

                        <div class="form-group">
                        <label>Details Image 2</label>
					<input type="file" name="hinhanh2">
                        </div>

                    </div>
                    <div class="col-md-5">
                        
                        <div class="form-group">
                        <label>Quantity</label>
					<input type="text" class="form-control" name="soluong" placeholder="Quantity">
                            </div>

                            <div class="form-group">
                        <label>Size</label>
					<input type="text" class="form-control" name="size" placeholder="Size">
                            </div>

                        <div class="form-group">
                            <label>Special Product</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="sanpham_hot" id="optionsRadios1" value=1>Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="sanpham_hot" id="optionsRadios2" value=0 checked>No
                                </label>
                            </div>


                        </div>

                        <div class="form-group">
                        <label>Category</label>
					<?php
					$sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
					?>
					<select name="danhmuc" class="form-control">
						<option value="0">-----Choose Category-----</option>
						<?php
						while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
						?>
						<option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
						<?php 
						}
						?>
					</select>
                        </div>


                        <button type="submit" class="btn btn-primary" name="themsanpham">Add</button>

                    </div>



                </form>
                </div>
                <!-- /Widgets -->
             
                <!--  /Traffic -->
               
            
       
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>


