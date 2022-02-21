<?php
	
include("partials/menu.php");

?>


<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>
		<br>
		<br>
		<?php  
		if (isset($_SESSION['upload']))
		 {
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}

		  ?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Title of the Food">
					</td>
				</tr>
				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
					</td>
				</tr>

				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price" >
					</td>
				</tr>

				<tr>
					<td>Select Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">
							<?php 
							// Create php code to display categories from database

							// 1.create sql to get all active categories

							$sql="SELECT * from tbl_category WHERE active = 'Yes'";
							//Executing query
							$res=mysqli_query($conn,$sql);

							//count rows to check whether we have categories or not 

							$count=mysqli_num_rows($res);
							if($count>0)
							{
								// we have categories
								while ($row=mysqli_fetch_assoc($res))
								 {
									//get the details of category
									$id= $row['id'];
									$title=$row['title'];
									?>

									<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
									

									<?php
								}
							}
							else
							{
								// no category exist
								?>
								<option value="0">No Category Found</option>
								<?php

							
							}

							// Display on dropdown 						

							  ?>

							
						</select>

					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="yes"> Yes
						<input type="radio" name="featured" value="no"> No
					</td>

				</tr>

					<td>Active: </td>
					<td>
						<input type="radio" name="active" value="yes"> Yes
						<input type="radio" name="active" value="no"> No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Food" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>


		<?php
			// check whether the button is clicked or not
		if (isset($_POST['submit']))
		 {
			// add the food in database
			//echo "Successfully Added";

			// 1.Get the data from the form 
			$title=$_POST['title'];
			$description=$_POST['description'];
			$price=$_POST['price'];
			$category=$_POST['category'];

			// check whether radio button for featured or active are checked or not

			if (isset($_POST['featured']))
		 {
			// get the value from the form
			$featured=$_POST['featured'];
		}
		else
		{
			// set the default value
			$featured="no";
		}

		if (isset($_POST['active']))
		 {
			// get the value from the form
			$active=$_POST['active'];
		}
		else
		{
			// set the default value
			$active="no";
		}

			// 2.Upload the image if selected

		// check whether the select image image is clicked or not and upload the image only if the image is selected

		if (isset($_FILES['image']['name'])) 
		{
			// get the details of the selected image
			$image_name=$_FILES['image']['name'];

			// check whether the image is selected or not and upload image only if selected
			if($image_name!="")
			{
				// image is selected


				// 1.Rename the image
				//get the extentsion of selected image eg:jpg,png,gif
				$ext=end(explode('.',$image_name));

				// create new name for image
				$image_name="Food-Name-".rand(0000,9999).".".$ext;


				// 2.Upload the image

				// get source path and destination path 

				// source path is the current location of the image

				$src=$_FILES['image']['tmp_name'];

				// destination path to be uploaded

				$dst="../images/food/".$image_name;

				// finally upload the image 

				$upload=move_uploaded_file($src, $dst);

				// check whether image uploaded or not

				if ($upload==false)
				 {
					// failed to upload the image

					// redirect to add food page with error message
				 	$_SESSION['upload'] ="<div class='error'>Failed to Upload Image</div>";
				 	header('location:'.SITEURL.'admin/add-food.php');
					// stop the process
					die();
				}

			}
		
			
		}

		else
		{
			$image_name=""; //setting default value as blank		
		}


			// 3.insert the data in the database

				// 3.1Create sql query to save or add food --- for numerical value we do not need to pass '' inside codes
			$sql2="INSERT INTO tbl_food SET
			title='$title',
			description='$description',
			price = $price,
			image_name= '$image_name',
			category_id = $category,
			featured= '$featured',
			active='$active'
			";


			// execute the query

			$res2=mysqli_query($conn,$sql2);

			// check whether data inserted are not
			//4.Redirect with message to manage food page
			if ($res2==true)
			 {
				// data inserted successfully
				$_SESSION['add'] = "<div class='success'>Food Successfully Added </div>";
				header('location:'.SITEURL.'admin/manage-food.php');
			}

			else
			{
				// failed to insert data
				$_SESSION['add'] = "<div class='error'>Failed To Add Food</div>";
				header('location:'.SITEURL.'admin/manage-food.php');
			}

			

		}

		?>




	</div>


</div>



















<?php
include("partials/footer.php");
?>