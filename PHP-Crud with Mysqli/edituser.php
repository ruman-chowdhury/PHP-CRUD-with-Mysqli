<?php 
	include 'inc/header.php';
	include 'lib/Database.php'; 
?>

<?php
	if (isset($_GET['id'])){
		$userid = (int)$_GET['id'];
	}

	$db =  new Database();
	$userData = $db->getUserById($userid);

?>

<?php  
	if (($_SERVER['REQUEST_METHOD']=="POST") && isset($_POST['update']) ){
		
		$update_result = $db->updateData($userid,$_POST);
	}
?>

	<div class="container content_container">
			
			<div class="card">
				<div class="card-header bg-light">
					<h2>
						Update <strong>User</strong>
						<span class="float-right">
							<a class="btn btn-outline-dark" href="index.php">Home</a>
						</span>
					</h2>
				</div>

<?php  
	if (isset($update_result)){
		echo $update_result;
	}
?>
				
				<div class="card-body custom_card_body">
					
					<form action="edituser.php?id=<?php echo $userid;?>" method="POST" accept-charset="utf-8" class="bg-light custom_form">

						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" name="name" class="form-control" id="name" value="<?php echo $userData['Name'];?> ">
						</div>


						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" name="email" class="form-control" id="email" value="<?php echo $userData['Email'];?> ">
						</div>

						<div class="form-group">
							<label for="number">Phone No:</label>
							<input type="number" name="phone" class="form-control" id="number" value="<?php echo $userData['Phone'];?> ">
						</div>
						
						

						<div class="form-group">
							<button type="submit" name="update" class="btn btn-success">Update</button>

							<input type="reset" class="btn btn-outline-secondary" value="Cancel">

						</div>
						

					</form>

				</div>

			</div> <!-- card -->

		</div> <!-- body contents -->


<?php include 'inc/footer.php'; ?>