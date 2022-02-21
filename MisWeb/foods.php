<?php  include('partials-front/menu.php'); ?>


 <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



<section class="food-menu">
		<div class="container">
			<h2 class="text-center">Food Menu</h2>

			 <?php 

            // getting foods from database that are active and featured 
            $sql2="SELECT * FROM tbl_food WHERE active='yes'";

            // execute the query  
            $res2=mysqli_query($conn,$sql2);

            // count the rows 

            $count2=mysqli_num_rows($res2);

            // check whether food available or not  

            if ($count2>0)
             {
                // food available 
                while ($row2=mysqli_fetch_assoc($res2))
                {
                    // get all the values 

                    $id=$row2['id'];
                    $title=$row2['title'];
                    $price=$row2['price'];
                    $description=$row2['description'];   
                    $image_name=$row2['image_name'];

                    ?>

                     <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php  
                            // check whether image available or not 
                            if ($image_name=="")
                             {
                              // image not available 
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                                // image available 
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>


                            
                        </div>

                        <div class="food-menu-desc">
                                <h4><?php  echo $title; ?></h4>
                                <p class="food-price">Rs.<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>



                    <?php  
                }

            }
            else
            {
                // food Not available  
                echo "<div class='error'>Food Not Available</div>";
            }








             ?>
			
			<div class="clearfix">
				
			</div>
		</div>
	</section>

<?php  include('partials-front/footer.php'); ?>