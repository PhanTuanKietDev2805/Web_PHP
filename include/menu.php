<?php
          $sql_category = mysqli_query($con, 'SELECT * FROM tbl_category ORDER BY category_id DESC');
?>
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <a href="?quanly=sanpham">Shop</a>
            </li>
            <li>
            <?php
                      while($row_category = mysqli_fetch_array($sql_category))
                      {
            ?>
                <li><a href="?quanly=danhmuc&id=<?php echo $row_category['category_id'] ?>"><?php echo $row_category['category_name'] ?></a></li>
                <?php
                      }
                ?>
            </li>
            <li><a href="?quanly=about">About</a></li>
          </ul>
        </div>
      </nav>