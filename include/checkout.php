
<?php
   if (isset($_POST['thanhtoan']))
    {
      $id = '';
      $id = $_SESSION['khachhang_id'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $note = $_POST['note'];
      $address = $_POST['address'];
      $giaohang = $_POST['giaohang'];
      $trangthai = "";
      if( isset($_SESSION['dangnhap_home']) && isset($_SESSION['taikhoan_home']) && isset($_SESSION['matkhau_home']))
      {
        $sql_khachhang = mysqli_query($con,"UPDATE tbl_khachhang SET phone = '$phone', address = '$address', note = '$note', giaohang = '$giaohang', trangthai = 1 WHERE khachhang_id ='$id' " );
      }
      else
      {
      $sql_khachhang = mysqli_query($con,"INSERT INTO tbl_khachhang(name, phone,address, note,email, password, giaohang, trangthai) values ('$name','$phone','$address','$note','$email','$password','$giaohang', 1)");
      }
      if($sql_khachhang){
        $sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
        
        $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
        $khachhang_id = $row_khachhang['khachhang_id'];
        $mahang = rand(0,9999);
        for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
          
          $sanpham_id = $_POST['thanhtoan_product_id'][$i];
          $soluong = $_POST['thanhtoan_soluong'][$i];
          $sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
          $sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
          $sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
        }
       
   
      }
      
      header('Location:?quanly=thanhcong');
    }
    
?>
<div class="bg-light py-3">
        <div class="container">
            <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
            </div>
        </div>
        </div>  
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
        <?php 
                    if (!isset($_SESSION['dangnhap_home']) && !isset($_SESSION['email_login']) && !isset($_SESSION['password_login'])){
        ?>
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              Returning customer? <a href="login.php">Click here</a> to login
            </div>
          </div>
        </div>
        
        <?php
            } else {
        ?>
        
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Billing Details</h2>
            <div class="p-3 p-lg-5 border">
            <div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="" required="" value = '<?php echo $_SESSION['dangnhap_home']?>'> 
                    
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Your Phone Number" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Address" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email" name="email" required="" value="<?php echo $_SESSION['taikhoan_home']?>" >
									</div>
                  <div class="controls form-group">
										<input type="password" class="form-control" placeholder="Password" name="password" required="" value="<?php echo $_SESSION['matkhau_home']?>" hidden>
									</div>
                  
									<div class="controls form-group">
										<textarea style="resize: none;" class="form-control" placeholder="Note" name="note" required=""></textarea>  
									</div>
									<div class="controls form-group">
										<select class="form-select" aria-label="Default select example" name="giaohang">
                    
										
											<option value="0">Cash On Delivery</option>

										</select>
									</div>
								</div>
           
								<div class="row">
                  <div class="col-md-12">
                      <?php
                    $sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
                    while($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)){ 
                    ?>
                      <input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
                      <input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
                    <?php
                    } 
                    ?>
                   
                  </div>
                </div>
							</div>
						</div>
				
					
				</div>
			</div>
            

          </div>
          </div>
          <div class="col-md-6">

           
            
            <div class="row mb-5">
            <form class="col-md-12" action="" method="post">
              <?php 
                    $sql_lay_giohang = mysqli_query($con, "SELECT * FROM tbl_giohang ORDER BY giohang_id DESC ");
              ?>
              <div class="col-md-12">
            
              <h2 class="h3 mb-3 text-black">Your Order : <?php echo $_SESSION['dangnhap_home']?></h2>
                <div class="p-3 p-lg-5 border">
                
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Size</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                        while($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang ))
                        {
                            $subtotal = $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham'];
                            $total+=$subtotal ;
                            
                    ?> 
                      <tr>
                        <td><?php echo $row_fetch_giohang['tensanpham']?> <strong class="mx-2">x</strong><?php echo $row_fetch_giohang['soluong'] ?> </td>
                        <td><?php echo $row_fetch_giohang['size']?></td>
                        <td><?php echo number_format($subtotal)?></td>
                      </tr>
                     
                      <?php
                        }
                      ?>
                       <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong></strong></td>
                        <td class="text-black font-weight-bold"><strong><?php echo number_format($total) ?></strong></td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <div class="border p-3 mb-3">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                    <div class="collapse" id="collapsebank">
                      <div class="py-2">
                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>

                  <div class="border p-3 mb-3">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                    <div class="collapse" id="collapsecheque">
                      <div class="py-2">
                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>

                  <div class="border p-3 mb-5">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                    <div class="collapse" id="collapsepaypal">
                      <div class="py-2">
                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                 <input type="submit" name="thanhtoan" value="PLACE ORDER" class="btn btn-primary btn-lg py-3 btn-block ">
                  </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
        
        <?php
            }
        ?>
        <!-- </form> -->
      </div>
    </div>
    