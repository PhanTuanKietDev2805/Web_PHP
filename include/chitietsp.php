
<?php
    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
    }
    else
    {
      $id = '';
    }
    $sql_chitiet = mysqli_query($con, "SELECT * FROM tbl_sanpham WHERE sanpham_id = '$id'");
?>
<?php
        while($row_chitiet = mysqli_fetch_array($sql_chitiet))
        {    
    ?>
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $row_chitiet['sanpham_name'] ?></strong></div>
            </div>
        </div>
        </div>  

      
    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
           
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="images/<?php echo $row_chitiet['sanpham_image'] ?>" alt="Image" class="img-fluid">
                </div>
                <div class="carousel-item">
                <img src="images/<?php echo $row_chitiet['sanpham_image1'] ?>" alt="Image" class="img-fluid">
                </div>
                <div class="carousel-item">
                <img src="images/<?php echo $row_chitiet['sanpham_image2'] ?>" alt="Image" class="img-fluid">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $row_chitiet['sanpham_name'] ?></h2>
            <p><?php echo $row_chitiet['sanpham_chitiet'] ?></p>
            
            <p><strong class="text-primary h4"><?php echo number_format($row_chitiet['sanpham_gia']) ?></strong></p>
            <p>Choose Your Size</p>
            <div class="mb-1 d-flex">
              <label for="option-sm" class="d-flex mr-3 mb-3">
                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-sm" name="size" checked></span> <span class="d-inline-block text-black"><?php echo $row_chitiet['sanpham_size'] ?></span>
              </label>

            </div>
            
            

            <div class="occasion-cart">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
							<form action="?quanly=giohang" method="post">
								<fieldset>
									<input type="hidden" name="tensanpham" value="<?php echo $row_chitiet['sanpham_name'] ?>" />
									<input type="hidden" name="sanpham_id" value="<?php echo $row_chitiet['sanpham_id'] ?>" />
									<input type="hidden" name="giasanpham" value="<?php echo $row_chitiet['sanpham_gia'] ?>" />
									<input type="hidden" name="hinhanh" value="<?php echo $row_chitiet['sanpham_image'] ?>" />
                  <input type="hidden" name="size" value="<?php echo $row_chitiet['sanpham_size'] ?>" />
									<input type="hidden" name="soluong" value="1" />			
                  <input type="submit" name ="themgiohang" value="Add To Cart" class="btn btn-primary btn-sm">  
								</fieldset>
							</form>
						</div>
					</div>

          </div>
        </div>
      </div>
    </div>
    <?php
        }
    ?>

<div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Featured Products</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
            <?php
            $sql_product_hot = mysqli_query($con, "SELECT * FROM tbl_sanpham WHERE sanpham_hot = '1' ORDER BY sanpham_id DESC");
            while($row_product_hot = mysqli_fetch_array($sql_product_hot))
            { 
            ?>
              <div class="item">
                <div class="block-4 text-center">
                  <figure class="block-4-image">
                    <img src="images/<?php echo $row_product_hot['sanpham_image'] ?>" alt="Image placeholder" class="img-fluid">
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="?quanly=chitietsp&id=<?php echo $row_product_hot['sanpham_id'] ?>"><?php echo $row_product_hot['sanpham_name'] ?></a></h3>
                    <p class="mb-0">Finding perfect t-shirt</p>
                    <p class="text-primary font-weight-bold"><?php echo number_format($row_product_hot['sanpham_gia']) ?></p>
                  </div>
                </div>
              </div>
              <?php
            }
              ?>
              
            </div>
          </div>
        </div>
      </div>
    </div>