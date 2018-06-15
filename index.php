<?php

	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);

	require 'vendor/autoload.php';


	$test = new App\View;

	if (isset($_POST['submit'])) {

		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$test->insertData($name,$email,$password);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Database Entries</title>
</head>
<body>
	<form action="index.php" method="post">
	    <p>
	        <label for="firstName">Name:</label>
	        <input type="text" name="name" id="Name">
	    </p>
	    <p>
	        <label for="emailAddress">Email Address:</label>
	        <input type="text" name="email" id="emailAddress">
	    </p>
	    <p>
	        <label for="password">Password:</label>
	        <input type="password" name="password" id="password">
	    </p>
	    <input type="submit" name="submit" value="Submit">
	</form> <br><br><br>
	<form action="index.php" method="post">
		<input type="submit" name="allentries" value="Get Entries">
	</form>
	<?php 
		if (isset($_POST['allentries'])) :
			// echo "<pre>";
			// print_r($test->getAll());
			// echo "</pre>";
			$rows = $test->getAll();
	?>
		<table border="1">
	        <tr>
	            <th>id</th>
	            <th>name</th>
	            <th>email</th>
	            <th>validity of email</th>
	            <th>hash password</th>
	            <th>original password</th>
	            <th>Validity of password</th>
	        </tr>
		    <?php foreach($rows as $row): ?>
		    	<tr>
			    	<td><?php echo $row['id']  ?></td>
			    	<td><?php echo $row['name']  ?></td>
			    	<td><?php echo $row['email']  ?></td>
			    	<td><?php echo (filter_var($row['email'], FILTER_VALIDATE_EMAIL)) ?"Email is valid" : "Email is NOT valid"; ?>  	</td>
			    	<td><?php echo $row['hashpass'] ?></td>
			    	<td><?php echo $row['password'] ?></td>
			<?php
				$hash = $row['hashpass'];
				if (password_verify($row['password'], $hash)): ?>
					<td><?php echo 'Password is valid!'; ?> </td>
			<?php
				else: 
			?>
					<td><?php echo 'Invalid password.'; ?> </td>
			<?php	    
			    endif;
			?>
		    	</tr>
		    <?php endforeach;?> 
		</table> 
	<?php endif; ?>
</body>
</html>