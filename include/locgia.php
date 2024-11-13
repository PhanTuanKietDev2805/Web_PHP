<?php
          if(isset($_GET['page'])){
            $page=$_GET['page'];
        }else{
            $page=1;
        }
        $rowPerPage=6;
        $perRow=$page*$rowPerPage-$rowPerPage;
        $startprice= "";
        $endprice = "";
        

        if(isset($_POST['start_price']) && isset($_POST['end_price']) )
        {
        
          $startprice = $_POST['start_price'];
          $endprice = $_POST['end_price']; 
        }
        else
        {
          $startprice = $_GET['start_price'];
          $endprice = $_GET['end_price']; 
        }
      
        $sql= "SELECT * FROM tbl_sanpham WHERE sanpham_gia BETWEEN  $startprice AND $endprice AND tinhtrang = 1 ORDER BY sanpham_id DESC LIMIT $perRow, $rowPerPage";
        $query= mysqli_query($con, $sql);
        $totalRow=mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_sanpham WHERE sanpham_gia BETWEEN  $startprice AND $endprice AND tinhtrang = 1"));
        $totalPage=ceil($totalRow/$rowPerPage);
        $list_page='';
        $prev="";
        $first="";
        $next="";
        $last="";
        for($i=1;$i<=$totalPage;$i++){
            if($page==$i){
                $list_page.= '<li class="active" ><a href="?quanly=locgia&start_price='.$startprice.'&end_price='.$endprice.'&page='.$i.'">'.$i.'</a></li>';
            }else{
                $list_page.= '<li><a href="?quanly=locgia&start_price='.$startprice.'&end_price='.$endprice.'&page='.$i.'">'.$i.'</a></li>';
            }
        }
        if ( $page > 1)
                {
                  $i  =  $page - 1;
                  $prev.='<li><a href="?quanly=locgia&start_price='.$startprice.'&end_price='.$endprice.'&page='.$i.'">&lt;</a></li>';

                  $first.='<li><a href="?quanly=locgia&start_price='.$startprice.'&end_price='.$endprice.'&page=1">«</a></li>';
                }

                if ( $page < $totalPage)
                {
                  $i  =  $page + 1;
                  $next.='<li><a href="?quanly=locgia&start_price='.$startprice.'&end_price='.$endprice.'&page='.$i.'">&gt;</a></li>';

                  $last.='<li><a href="?quanly=locgia&start_price='.$startprice.'&end_price='.$endprice.'&page='.$totalPage.'">»</a></li>';
                }

              
               
	?> 
  <div class="bg-light py-3">
        <div class="container">
            <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"></strong></div>
            </div>
        </div>
        </div>  
<div class="site-section">

      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"></div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto">
                    
                   
                  </div>
                  
                </div>
              </div>
            </div>
            
            <div class="row mb-5">

              <?php
                  while($row_sanpham = mysqli_fetch_array($query ))
                  {
                    
              ?> 
              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"><img src="images/<?php echo $row_sanpham['sanpham_image']?>" alt="Image placeholder" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"><?php echo $row_sanpham['sanpham_name']?></a></h3>
                    <p class="mb-0">Finding perfect t-shirt</p>
                    <p class="text-primary font-weight-bold"><?php echo number_format($row_sanpham['sanpham_gia']) ?></p>
                  </div>
                </div>

              </div>
              <?php
                }
              ?>
            </div>
            


            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  
                  <ul>
                     
                  <?php  
                  echo $first . $prev . $list_page . $next . $last;
                  ?>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <?php
          $sql_category = mysqli_query($con, 'SELECT * FROM tbl_category ORDER BY category_id DESC');
          ?>
          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
              <ul class="list-unstyled mb-0">
              <?php
                      while($row_category = mysqli_fetch_array($sql_category))
                      {
                ?>
                <li class="mb-1"><a href="?quanly=danhmuc&id=<?php echo $row_category['category_id'] ?>" class="d-flex"><span><?php echo $row_category['category_name'] ?></span></a></li>

              <?php
                      }
              ?>
              </ul>
            </div>

            <div class="border p-4 rounded mb-4">
              

              <div class="mb-4">
              <form action="index.php?quanly=locgia" method="POST">
                <label for="">Start Price</label>
                <input type="text" name ="start_price" value="<?php if(isset($_POST['start_price'])){echo $_POST['start_price']; }  ?>" class ="form-control">
                <label for="">End Price</label>
                <input type="text" name ="end_price" value="<?php if(isset($_POST['end_price'])){echo $_POST['end_price']; }  ?>" class ="form-control">
                <br>
                <button type="submit" class ="btn btn-primary px-4">Filter</button>
                </form>
              </div>
 

            </div>
          </div>
        </div>
        <?php
          $sql_category = mysqli_query($con, 'SELECT * FROM tbl_category ORDER BY category_id DESC');
      ?>
    <div class="row">
    <div class="site-section block-3 site-blocks-2 ">
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
            $sql_product_hot = mysqli_query($con, "SELECT * FROM tbl_sanpham WHERE sanpham_hot = '1' AND tinhtrang = '1' ORDER BY sanpham_id DESC");
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
        
      </div>
              
            </div>
          </div>
        </div>
        
      </div>
    </div>