<?php
include('../config/constants.php');
	
//	echo "success";
	
if (isset($_GET['id']) && isset($_GET['image_name']))  //either use && or 'AND'
{
	// process to delete
	//echo "Process To delete";

	//1.Get id and image name

	$id=$_GET['id'];
	$image_name=$_GET['image_name'];


	//2.remove the image if avaible
	//check if the image name is avaibale or not and delete  only if the image is available

	if ($image_name != "")
	 {
		// get the image path

		$path="../images/food/".$image_name;

		// remove image file from folder 

		$remove=unlink($path);

		// check whether the image is removed or not 
		if($remove == false)
		{
			// failed to remove image
			$_SESSION['upload']="<div class='error'>Failed To Remove Image File</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
			die();
		}
	}

	//3. Delete Food from database

	$sql="DELETE FROM tbl_food WHERE id=$id";

	// execute the query 

	$res=mysqli_query($conn,$sql);

	// check whether the query executed or not and set the session message respectively

	if($res==true)
	{
		// food deleted
		$_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
		header('location:'.SITEURL.'admin/manage-food.php');
	}
	else
	{
		// failed to delete food
		$_SESSION['delete']="<div class='error'>Failed To Delete Food.</div>";
		header('location:'.SITEURL.'admin/manage-food.php');
	}

	//4. Redirect to manage food with session message
}
else
{
	// redirect to manage food page
	//echo "Redirect";
	$_SESSION['unauthorize']= "<div class='error'>Unauthorized Access</div>";
	header('location:'.SITEURL.'admin/manage-food.php');
}	


?>