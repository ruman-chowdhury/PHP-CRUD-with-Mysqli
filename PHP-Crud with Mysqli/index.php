<?php 
	include 'inc/header.php';
	include 'lib/Database.php'; 
?>

<?php 
	$db =  new Database();
	$read = $db->selectData();
	
?>

<?php  
	if (isset($_GET['del'])){		
		$id = $_GET['del'];
		
		$db->deleteData($id);

	}

?>



		<!-- body contents -->
		<div class="container content_container">
			
			<div class="card">
				<div class="card-header bg-light">
					<h2>
						User <strong>List</strong>
						<span class="float-right">
							<a class="btn btn-success" href="adduser.php">Add User</a>
						</span>
					</h2>
				</div>


				<div class="card-body custom_card_body">
					<table class="table table-borderless">
						<tr >
							<th>Serial</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Action</th>
						</tr>


<?php  
	if ($read){
		$i=0;
		while($row = $read->fetch_assoc()){	
		$i++;
?>

						<tr>
							<td> <?php echo $i; ?> </td>
							<td> <?php echo $row['Name']; ?> </td>
							<td> <?php echo $row['Email']; ?> </td>
							<td> <?php echo $row['Phone']; ?> </td>
							<td>
								<a class="btn btn-outline-secondary btn-sm" href="edituser.php?id=<?php echo $row['Id'];?> ">Edit</a>
								
								<a class="btn btn-danger btn-sm" href="index.php?del=<?php echo $row['Id']; ?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
							</td>
						</tr>


<?php } ?>
<?php }else{ ?>

					</table>
	
			
				<p class="text-secondary text-center error_msg">Data not Found!</p> 
			

<?php } ?>	


				</div><!-- card body -->

			</div> <!-- card -->

		</div> <!-- body contents -->
		
	</div><!-- main container -->



<?php include 'inc/footer.php'; ?>