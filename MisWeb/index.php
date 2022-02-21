<?php include('partials-front/menu.php');  ?>




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


    <?php 
     
        if (isset($_SESSION['order']))
         {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }


    ?>




    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php  

            // create sql query to display the categories from database 

            $sql="SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' LIMIT 3";

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
    <!-- Categories Section Ends Here -->





    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>



            <?php 

            // getting foods from database that are active and featured 
            $sql2="SELECT * FROM tbl_food WHERE featured='yes' AND active='yes' LIMIT 6";

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

            
            <div class="clearfix"></div>
        </div>

        
    </section>
    <!-- Food Menu Section Ends Here -->

  <?php  include('partials-front/footer.php'); ?>