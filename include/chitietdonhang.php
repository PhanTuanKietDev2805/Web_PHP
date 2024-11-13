<div class="site-section">
      <div class="container">
        <div class="row mb-5">
        <h2 class="h5 text-black" style = "text-align: center;">View Details</h2>
		<?php
								if(isset($_GET['magiaodich'])){
									$magiaodich = $_GET['magiaodich'];
								}else{
									$magiaodich = '';
								}
								$sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich,tbl_khachhang,tbl_sanpham WHERE tbl_giaodich.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id AND tbl_giaodich.magiaodich='$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC"); 
								?> 
        
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
				<tr>
										<th>No.</th>
										<th>Code Transaction</th>
										<th>Product Name</th>
										<th>Size</th>
										<th>Quantity</th>
										<th>Price</th>
										<th>Total</th>
										<th>Date</th>
										
									</tr>
                </thead>
                <tbody>
                        
				<?php
									$total = 0;
									$i = 0;
									while($row_donhang = mysqli_fetch_array($sql_select)){ 
										$subtotal = $row_donhang['soluong'] * $row_donhang['sanpham_gia'];
										$total+=$subtotal ;
										$i++;
									?> 
									<tr>
										<td><?php echo $i; ?></td>
										
										<td><?php echo $row_donhang['magiaodich']; ?></td>
									
										<td><?php echo $row_donhang['sanpham_name']; ?></td>

										<td><?php echo $row_donhang['sanpham_size']; ?></td>

										<td><?php echo $row_donhang['soluong']; ?></td>

										<td><?php echo number_format($row_donhang['sanpham_gia']); ?></td>

										<td><?php echo number_format($subtotal)?></td>
										
										<td><?php echo $row_donhang['ngaythang'] ?></td>
									
										
									</tr>
									 <?php
									} 
									?> 
                </tbody>
              </table>

			  <table class="table table-bordered">
                <tbody>
                        
	
									<tr>
									<td class="text-black font-weight-bold">Order Totals: <?php echo number_format($total) ?> </td>							
									</tr>
									
                </tbody>
              </table>
            </div>

        </div>

      
          
          
            </div>
          </div>
        </div>
      </div>
    </div>