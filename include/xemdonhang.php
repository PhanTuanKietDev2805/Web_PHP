<?php
if(isset($_SESSION['dangnhap_home']) ){
	$id = $_SESSION['khachhang_id'];
?>
<?php
			if(isset($_GET['khachhang']))
            {
			$id_khachhang = $_GET['khachhang'];
			}
            else
            {
			$id_khachhang = '';
			}
			$sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich, tbl_donhang WHERE tbl_giaodich.khachhang_id='$id' GROUP BY tbl_giaodich.magiaodich"); 
?> 
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
        <h2 class="h5 text-black" style = "text-align: center;">Your Order : <?php echo $_SESSION['dangnhap_home'] ?></h2>
        
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  	<th>No.</th>
				    <th>Code Transaction</th>
                    <th>Date</th>
					<th>Manage</th>
					<th>Status</th>				
										
                  </tr>
                </thead>
                <tbody>
                        
                <tr>
                <?php
				$i = 0;
			    while($row_donhang = mysqli_fetch_array($sql_select)){ 
			    $i++;
				?> 
				<td><?php echo $i; ?></td>
										
				<td><?php echo $row_donhang['magiaodich']; ?></td>
									
										
				<td><?php echo $row_donhang['ngaythang'] ?></td>
				<td><a href="index.php?quanly=chitietdonhang&khachhang=<?php echo $id ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>">View Details</a></td>
				<td><?php 
				if($row_donhang['tinhtrangdon']==0){
					echo 'Ordered';
				}else{
					echo 'Processed | Deliver';
				}
				?></td>
				</tr>
			     <?php
				} 
				?> 
                  
                </tbody>
              </table>
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


