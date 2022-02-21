<?php  include('partials-front/menu.php'); ?>

<!--Food Search Starts -->
	<section class="food-search text-center">
		<div class="container">
			<?php 
					$search=mysqli_real_escape_string($conn,$_POST['search']);
			  ?>
			<h2>Results on<a href="#" class="text-white"> <?php echo $search; ?></a></h2>
		</div>
	</section>
<!--Food Search Ends-->

<section class="food-menu">
		<div class="container">
			<h2 class="text-center">Food Menu</h2>


			<?php   


				// sql query to get food based on search keyword
			// $search=burger'  ->with single quote

			// SELECT * FROM tbl_food WHERE title '%%' OR description LIKE '%%'";

				$sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

				// execute the query 
				$res = mysqli_query($conn,$sql);

				// count rows 
				$count=mysqli_num_rows($res);

				// check whether food available or not 

				if ($count>0)
				 {
					// food available 
					while ($row=mysqli_fetch_assoc($res))
					 {
						// get the details 
						$id=$row['id'];
						$title=$row['title'];
						$price=$row['price'];
						$description=$row['description'];
						$image_name=$row['image_name'];
				?>

				<div class="food-menu-box">
				<div class="food-menu-img">

					<?php  
					 if ($image_name!="")
					  {
					  	?>

					  	<img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
					  	<?php 
					 	
					 }
					 else
					 {
					 	// image not available 
					 	echo "<div class=''error'>Image Not Available</div>";
					 }

					 ?>
					
				</div>
				<div class="food-menu-desc">
					<h4><?php echo $title; ?></h4>
					<p class="food-price">Rs.<?php echo $price ?></p>
					<p class="food-detail"><?php echo $description; ?></p>
					<br>
				<a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order now</a>
				</div>
			</div>

				<?php  

					}
				}
				else
				{
					// food not availbale 
					echo "<div class='error'>Food Not Available</div>";
				}
			?>

	
			<div class="clearfix"></div>
		</div>
	</section>

<?php  include('partials-front/footer.php'); ?>