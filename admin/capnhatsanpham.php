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
    if(isset($_POST['capnhatsanpham'])) {
		$id_update = $_POST['id_update'];
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $hinhanh1 = $_FILES['hinhanh1']['name'];
		$hinhanh_tmp1 = $_FILES['hinhanh1']['tmp_name'];
        $hinhanh2 = $_FILES['hinhanh2']['name'];
		$hinhanh_tmp2 = $_FILES['hinhanh2']['tmp_name'];
		$soluong = $_POST['soluong'];
		$gia = $_POST['giasanpham'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
        $hot = $_POST['hot'];
        $tinhtrang = $_POST['tinhtrang'];
        $size = $_POST['size'];
		$path = '../images/';
		if($hinhanh=='' && $hinhanh1=='' && $hinhanh2==''){
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_gia='$gia',sanpham_hot='$hot',sanpham_soluong='$soluong',category_id='$danhmuc', tinhtrang = '$tinhtrang', sanpham_size = '$size' WHERE sanpham_id='$id_update'";
		}else
        if($hinhanh=='' && $hinhanh1=='' ){
            move_uploaded_file($hinhanh_tmp2,$path.$hinhanh2);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_gia='$gia',sanpham_hot='$hot',sanpham_soluong='$soluong',sanpham_image2='$hinhanh2',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}
        else 
        if($hinhanh=='' && $hinhanh2==''){
            move_uploaded_file($hinhanh_tmp1,$path.$hinhanh1);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_gia='$gia',sanpham_hot='$hot',sanpham_soluong='$soluong',sanpham_image1='$hinhanh1',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}
        else 
        if($hinhanh1=='' && $hinhanh2==''){
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_gia='$gia',sanpham_hot='$hot',sanpham_soluong='$soluong',sanpham_image='$hinhanh',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}
        else 
        if($hinhanh=='' ){
            move_uploaded_file($hinhanh_tmp1,$path.$hinhanh1);
            move_uploaded_file($hinhanh_tmp2,$path.$hinhanh2);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_gia='$gia',sanpham_hot='$hot',sanpham_soluong='$soluong',sanpham_image1='$hinhanh1',,sanpham_image2='$hinhanh2',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}
        else 
        if($hinhanh1== '' ){
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_gia='$gia',sanpham_hot='$hot',sanpham_soluong='$soluong',sanpham_image='$hinhanh',,sanpham_image='$hinhanh',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}
        else 
        if($hinhanh2== '' ){
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
            move_uploaded_file($hinhanh_tmp1,$path.$hinhanh1);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_gia='$gia',sanpham_hot='$hot',sanpham_soluong='$soluong',sanpham_image='$hinhanh',,sanpham_image1='$hinhanh1',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}
        else if($tensanpham == '' && $hinhanh=='' && $hinhanh1=='' && $hinhanh2=='' && $soluong == '' && $gia == '' && $chitiet =='' && $danhmuc == '' && $size == '')
        {
            $sql_update_image = "UPDATE tbl_sanpham SET  tinhtrang = '$tinhtrang' WHERE sanpham_id='$id_update'";
        }
        else{
			move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
            move_uploaded_file($hinhanh_tmp1,$path.$hinhanh1);
            move_uploaded_file($hinhanh_tmp2,$path.$hinhanh2);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_gia='$gia',sanpham_hot='$hot',sanpham_soluong='$soluong',sanpham_image='$hinhanh',sanpham_image1='$hinhanh1',sanpham_image2='$hinhanh2',category_id='$danhmuc', tinhtrang = '$tinhtrang', sanpham_size = '$size' WHERE sanpham_id='$id_update'";
		}
		mysqli_query($con,$sql_update_image);
        header('Location: sanpham.php');
	}
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shoppers - ADMIN</title>
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
                    <li class="">
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
        <?php
            $id_capnhat = $_GET['capnhat_id'];
            $sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_sanpham WHERE sanpham_id='$id_capnhat'");
            $row_capnhat = mysqli_fetch_array($sql_capnhat);
            $id_category_1 = $row_capnhat['category_id'];
        ?>
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                <div class="col-md-8">
				<h4>Update Product</h4>
				<br>    
				<form action="" method="POST" enctype="multipart/form-data">
                <div class="col-md-6">
                        <div class="form-group">
                        <label>Product Name</label>
					<input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>"><br>
					<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['sanpham_id'] ?>">
                        </div>
                        <div class="form-group">
                        <label>Price</label>
					<input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['sanpham_gia'] ?>">
                        </div>

                        <div class="form-group">
                        <label>Quantity</label>
					<input type="text" class="form-control" name="soluong" value="<?php echo $row_capnhat['sanpham_soluong'] ?>"><br>
                        </div>


                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file"  name="hinhanh"><input type="hidden" name="anh_sp" value="<?php echo $row_capnhat['sanpham_image'] ?>"> 
                        </div>

                        <div class="form-group">
                            <label>Details Image 1</label>
                            <input type="file"  name="hinhanh1"><input type="hidden" name="anh_sp" value="<?php echo $row_capnhat['sanpham_image1'] ?>"> 
                        </div>

                        <div class="form-group">
                             <label>Details Image 2</label>
                            <input type="file"  name="hinhanh2"><input type="hidden" name="anh_sp" value="<?php echo $row_capnhat['sanpham_image2'] ?>"> 
                        </div>

                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Size</label>
					<input type="text" class="form-control" name="size" value="<?php echo $row_capnhat['sanpham_size'] ?>"><br>
                        </div>
                        <div class="form-group">
                            <label>Special Product</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="hot"
                                        <?php 
                                            if($row_capnhat['sanpham_hot']==1)
                                            {
                                                echo 'checked';
                                            }
                                         ?>

                                     id="optionsRadios1" value=1>Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="hot"
                                        <?php 
                                            if($row_capnhat['sanpham_hot']==0)
                                            {
                                                echo 'checked';
                                            }
                                         ?>
                                     id="optionsRadios2" value=0>No
                                </label>
                            </div>

                            <div class="form-group">
                            <label>Hidden Product</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tinhtrang"
                                        <?php 
                                            if($row_capnhat['tinhtrang']==0)
                                            {
                                                echo 'checked';
                                            }
                                         ?>

                                     id="optionsRadios1" value=0>Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tinhtrang"
                                        <?php 
                                            if($row_capnhat['tinhtrang']==1)
                                            {
                                                echo 'checked';
                                            }
                                         ?>
                                     id="optionsRadios2" value=1>No
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
							if($id_category_1==$row_danhmuc['category_id']){
						?>
						<option selected value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
						<?php 
							}else{
						?>
						<option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
						<?php
							}
						}
						?>
					</select>
                        </div>
                        <div class="form-group">
                        <label>Details</label>
					<textarea class="form-control" rows="10" name="chitiet"><?php echo $row_capnhat['sanpham_chitiet'] ?></textarea><br>
                        </div>

					<input  type="submit" name="capnhatsanpham" value="Update" class="btn btn-default">
				</form>
				</div>

                

               

              
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
							
					<br>