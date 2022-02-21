<?php
include('partials/menu.php');
?>

<!--Main Content Selection Starts-->
	<div class="main-content">
		<div class="wrapper">
			<h1 style='color: green;'><center>Total Summary</center></h1>
			<br><br>
			<?php 
		if (isset($_SESSION['login']))
		 {
			echo $_SESSION['login'];
			unset($_SESSION['login']);
		}
		 ?>

		 <br><br>
			<div class="col-4 text-center">
				<?php  

				$sql="Select * FROM tbl_category";
				// execute the query 
				$res=mysqli_query($conn,$sql);

				$count=mysqli_num_rows($res);

				 ?>


				<h1><?php echo $count; ?></h1>
				<br><b>
				Categories
			</b>
			</div>


			<div class="col-4 text-center">
				<?php  

				$sql2="Select * FROM tbl_food";
				// execute the query 
				$res2=mysqli_query($conn,$sql2);

				$count2=mysqli_num_rows($res2);

				 ?>

				<h1><?php echo $count2; ?></h1>
				<br>
				<b>
				Foods
			</b>
			</div>

			<div class="col-4 text-center">
				<?php  

				$sql3="Select * FROM tbl_order";
				// execute the query 
				$res3=mysqli_query($conn,$sql3);

				$count3=mysqli_num_rows($res3);

				 ?>
				<h1><?php echo $count3; ?></h1>
				<br>
				<b>
				Total Orders
			</b>
			</div>


			<div class="col-4 text-center">

				<?php  
				// sql query to get total reveneue using aggregrate function in sql  
				$sql4="Select SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
				// execute the query 
				$res4=mysqli_query($conn,$sql4);

				$row4=mysqli_fetch_assoc($res4);

				// get the total revenue 
				$total_revenue=$row4['Total']; 

				

				 ?>
				<h1>Rs.<?php echo $total_revenue; ?></h1>
				<br>
				<b>
				Revenue Generated
			</b>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!--Main Content Selection Ends-->
	
<?php
include('partials/footer.php');
?>
	