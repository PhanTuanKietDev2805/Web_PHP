<script>
    function xoa(){
        var conf= confirm("Are You Sure?");
        return conf;
    }
</script>
<?php
     if(isset($_POST['themgiohang'])){
        $tensanpham = $_POST['tensanpham'];
        $sanpham_id = $_POST['sanpham_id'];
        $hinhanh = $_POST['hinhanh'];
        $gia = $_POST['giasanpham'];
        $soluong = $_POST['soluong'];	
        $size = $_POST['size'];	
        $sql_select_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
        $count = mysqli_num_rows($sql_select_giohang);
        if($count>0){
            $row_sanpham = mysqli_fetch_array($sql_select_giohang);
            $soluong = $row_sanpham['soluong'] + 1;
            $sql_giohang = "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'";
        }else{
            $soluong = $soluong;
            $sql_giohang = "INSERT INTO tbl_giohang(tensanpham,sanpham_id,giasanpham,hinhanh,soluong,size) values ('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong', '$size')";
   
        }
        $insert_row = mysqli_query($con,$sql_giohang);
    }
    else if(isset($_POST['capnhatsoluong'])){
 	
        for($i=0;$i<count($_POST['product_id']);$i++){
            $sanpham_id = $_POST['product_id'][$i];
            $soluong = $_POST['soluong'][$i];
            if($soluong<=0){
                $sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
            }else{
                $sql_update = mysqli_query($con,"UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'");
            }
        }
   
    }
    else if(isset($_GET['xoa'])){
        $id = $_GET['xoa'];
          $sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE giohang_id='$id'");
    
    }
   
        
?>
<div class="bg-light py-3">
        <div class="container">
            <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
            </div>
        </div>
        </div>  
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <?php
            $sql_select_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang");
            $count = mysqli_num_rows($sql_select_giohang);
            if($count > 0)
            {
          ?>
          <form class="col-md-12" action="" method="post">
              <?php 
                    $sql_lay_giohang = mysqli_query($con, "SELECT * FROM tbl_giohang ORDER BY giohang_id DESC ");
              ?>
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-price">Size</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
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
                    <td class="product-thumbnail">
                      <img src="images/<?php echo $row_fetch_giohang['hinhanh']?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $row_fetch_giohang['tensanpham']?></h2>
                    </td>
                    <td><?php echo number_format($row_fetch_giohang['giasanpham'])?></td>
                    <td><?php echo $row_fetch_giohang['size']?></td>
                    <td class="invert">
						<input type="hidden" name="product_id[]" value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
						<input type="number" min="1" name="soluong[]" value="<?php echo $row_fetch_giohang['soluong'] ?>">
								
									
					</td>
                    <td><?php echo number_format($subtotal) ?></td>
                    <td><a onclick="return xoa();" href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id']?>" class="btn btn-primary btn-sm" style="color: white ">X</a></td>
                  </tr>
                  <?php  
                  } 
                ?>
                </tbody>
              </table>
            </div>
                    
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
              <a href="?quanly=sanpham"><input  value="Continue Shopping" class="btn btn-primary btn-sm btn-block" ></a>
              </div>
              <div class="col-md-6 mb-3 mb-md-0">
              <input type="submit" value="Update Cart" class="btn btn-primary btn-sm btn-block" name ="capnhatsoluong">
              </div>
              </form>
              <div class="col-md-6">
              </div>
            </div>
            
            

          </div>
          
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
               
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo number_format($total) ?></strong>
                  </div>
                 
                </div>
                <a href="?quanly=muahang"><input type="submit" name="thanhtoan" value="Proceed To Checkout" class="btn btn-primary btn-sm"></a>

                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
            } else {
    ?>
    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Your Cart Is Empty</th>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
                    
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
              <a href="?quanly=sanpham"><input  value="Continue Shopping" class="btn btn-primary btn-sm btn-block" ></a>
              </div>
              <div class="col-md-6">
              </div>
            </div>
            
            

          </div>
          

                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
            }
     ?>                 
    
    