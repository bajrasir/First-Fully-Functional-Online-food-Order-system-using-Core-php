<?php  include('partials-front/menu.php'); ?>

	<section class="categories">
		<div class="container">
<?php  

            // create sql query to display the categories from database 

            $sql="SELECT * FROM tbl_category WHERE active='yes'";

            // execute the query 

            $res=mysqli_query($conn,$sql);

            // count the rows tp check whether the category is avaibale or not

            $count=mysqli_num_rows($res);


            if($count>0)
            {
                // categories available 
                while ($row=mysqli_fetch_assoc($res))
                 {
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];

                    ?>
                         <a href="<?php echo SITEURL;?>categories-food.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                            if ($image_name=="")
                             {
                                // display the message 
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                                // image available 
                                ?>
                                <img src="<?php SITEURL; ?>images/category/<?php echo $image_name;  ?>" alt="Pizza" class="img-responsive img-curve">
                                <?php 
                            }
                            ?> 
                        
                    <h3 class="float-text text-white"><?php echo $title;  ?></h3>
                            </div>
                            </a>

                    <?php
                    
                }


            }
            else
            {
                // categories not available
                echo "<div class='error;>Category Not Added.</div>"; 
            }

             ?>
			<div class="clearfix"></div>
		</div>
	</section>

	<?php  include('partials-front/footer.php'); ?>