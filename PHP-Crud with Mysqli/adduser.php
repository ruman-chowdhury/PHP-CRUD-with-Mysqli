<?php 
	include 'inc/header.php';
	include 'lib/Database.php';  
?>

<?php 
	$db =  new Database();

	if(($_SERVER['REQUEST_METHOD'] == "POST") && isset($_POST['adduser'])){
		
		$inserted_result = $db->insertData($_POST);

	}

	
?>


	<div class="container content_container">
			
		<div class="card">
				
				<div class="card-header bg-light">
					<h2>
						Add <strong>User</strong>
						<span class="float-right">
							<a class="btn btn-outline-dark" href="index.php">Home</a>
						</span>
					</h2>
				</div>
<?php 
	if (isset($inserted_result)){
		echo $inserted_result;
	}
?>
				
			<div class="card-body custom_card_body">
					
				<form action="adduser.php" method="POST" accept-charset="utf-8" class="bg-light custom_form">

						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" name="name" class="form-control" id="name">
						</div>


						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" name="email" class="form-control" id="email">
						</div>

						<div class="form-group">
							<label for="number">Phone No:</label>
							<input type="number" name="phone" class="form-control" id="number">
						</div>
						
						

						<div class="form-group">
							<input type="hidden" name="action" value="id">
							<input type="hidden" name="action" value="add">

							<button type="submit" name="adduser" class="btn btn-success">Add User</button>
							<input type="reset" class="btn btn-outline-secondary" value="Cancel">

						</div>
						

					</form>

				</div><!-- card body -->

			</div> <!-- card -->

			

		</div> <!-- body contents -->


<?php include 'inc/footer.php'; ?>