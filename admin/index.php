<?php
  session_start();
  include_once('C:/xampp/htdocs/web/db/connect.php');
?>
<?php
	// session_destroy();
	// unset('dangnhap');
	if(isset($_POST['dangnhap']))
	{
		$taikhoan = $_POST['taikhoan'];
		$matkhau = md5($_POST['matkhau']);
		if($taikhoan == '' || $matkhau == '')
		{
			echo'<center class="alert alert-danger">Please enter complete information!</center>';
		}
		else
		{
			$sql_select_admin = mysqli_query($con, "SELECT * FROM tbl_admin WHERE email = '$taikhoan' AND password = '$matkhau'  LIMIT 1");
			$count  = mysqli_num_rows($sql_select_admin);
			$row_dangnhap = mysqli_fetch_array($sql_select_admin);
			if($count > 0)
			{
				$_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
				$_SESSION['admin_id'] = $row_dangnhap['admin_id'];
				header('Location:dashboard.php');
			}
			else
			{
				echo'<center class="alert alert-danger">The account does not exist or you do not have access!</center>';
			}
			
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation">
								<div class="form-group">
									<label for="email">UserName</label>
									<input  type="text" class="form-control" name="taikhoan"  >
								</div>

								<div class="form-group">
									<label for="password">Password
									</label>
									<input id="password" type="password" class="form-control" name="matkhau"  data-eye>
								</div>

								

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block" name="dangnhap">
										Login
									</button>
								</div>
						
							</form>
						</div>
					</div>
					<div class="footer">
						
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>
