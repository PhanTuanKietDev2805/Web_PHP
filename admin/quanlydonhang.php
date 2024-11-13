<script>
    function xoadanhmuc(){
        var conf= confirm("Are you sure ?");
        return conf;
    }
</script>
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
    if(isset($_GET['xoadonhang'])){
		$mahang = $_GET['xoadonhang'];
		$sql_delete = mysqli_query($con,"DELETE FROM tbl_donhang WHERE mahang='$mahang'");
		header('Location:quanlydonhang.php');
	} 
    
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shopper - ADMIN</title>
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
                    <li >
                        <a href="sanpham.php" > <i class="menu-icon fa fa-tasks"></i>Product Manage</a>
                    </li>
                    <li  >
                        <a href="quanlyuser.php" > <i class="menu-icon fa fa-user"></i>User Manage</a>
                    </li>
                    <li class="active">
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
                <div class="col-md-12">
                <h4>Order Manage</h4>
                <br>
				<?php
                if(isset($_GET['page']))
                {
                    $page=$_GET['page'];
                }
                else{
                    $page=1;
                }
                $rowPerPage=6;
                $perPage=$page*$rowPerPage-$rowPerPage;
				$sql_select = mysqli_query($con,"SELECT * FROM tbl_sanpham,tbl_khachhang,tbl_donhang WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id GROUP BY mahang DESC LIMIT $perPage,$rowPerPage"); 
                $totalRows=mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_sanpham,tbl_khachhang,tbl_donhang WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id GROUP BY mahang"));
                 $totalPages=ceil($totalRows/$rowPerPage);
                 $list_page="";
                 $prev="";
                 $first="";
                 $next="";
                 $last="";
                for($i=1;$i<=$totalPages;$i++)
                    {
                        if($page==$i){
                            $list_page.='<li class="active"><a href="quanlydonhang.php?&page='.$i.'">'.$i.'</a></li>';
                        }
                        else{
                            $list_page.='<li><a href="quanlydonhang.php?&page='.$i.'">'.$i.'</a></li>';
                        }
                    }
                    if ( $page > 1)
                {
                    $i  =  $page - 1;
                    $prev.='<li><a href="quanlydonhang.php?&page='.$i.'">&lt;</a></li>';

                    $first.='<li><a href="quanlydonhang.php?&page=1">«</a></li>';
                }

                if ( $page < $totalPages)
                {
                    $i  =  $page + 1;
                    $next.='<li><a href="quanlydonhang.php?&page='.$i.'">&gt;</a></li>';

                    $last.='<li><a href="quanlydonhang.php?&page='.$totalPages.'">»</a></li>';
                }
				?> 
				<table class="table table-bordered ">
					<tr>
						<th>No.</th>
						<th>Product Code</th>
						<th>Order Status</th>
						<th>Name</th>
                        <th>Address</th>
                        <th>Phone Numbers</th>
						<th>Date</th>
						<th>Note</th>
						<th>Manage</th>
					</tr>
					<?php
					$i = 0;
					while($row_donhang = mysqli_fetch_array($sql_select)){ 
						$i++;
					?> 
					<tr>
						<td><?php echo $i; ?></td>
						
						<td><?php echo $row_donhang['mahang']; ?></td>
						<td><?php
							if($row_donhang['tinhtrang']==0){
								echo 'No Process';
							}else{
								echo 'Processed';
							}
						?></td>
						<td><?php echo $row_donhang['name']; ?></td>
						<td><?php echo $row_donhang['address']; ?></td>
                        <td><?php echo $row_donhang['phone']; ?></td>
						<td><?php echo $row_donhang['ngaythang'] ?></td>
						<td><?php echo $row_donhang['note'] ?></td>

						<td><a onclick="return xoadanhmuc();" href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Delete</a> || <a href="capnhatdonhang.php?&mahang=<?php echo $row_donhang['mahang'] ?>">View </a></td>
					</tr>
					 <?php
					} 
					?> 
				</table>
			</div>

           

                

                  
                </div>
                <!-- /Widgets -->
             
                <!--  /Traffic -->
                <ul class="pagination" style="float: right;">
                     <?php  
                        echo $first . $prev . $list_page . $next . $last;
                    ?>
                </ul> 
            
       
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
