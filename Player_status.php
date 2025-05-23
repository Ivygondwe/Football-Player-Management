

<!DOCTYPE html>
<html>
<head>
	<title>Player Status</title>
	<style>
		body {
			text-align: center;
			font-family: Arial, sans-serif;
		}
		
		h1 {
			margin-top: 50px;
		}

		form {
			display: inline-block;
			text-align: left;
			margin: 50px auto;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0px 0px 20px rgba(0,0,0,0.2);
		}

		label {
			display: block;
			margin-top: 10px;
			margin-bottom: 5px;
			font-weight: bold;
		}

		select, input {
			padding: 10px;
			border-radius: 5px;
			border: none;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
		}

		select:focus, input:focus {
			outline: none;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			font-weight: bold;
			cursor: pointer;
			transition: background-color 0.3s;
		}

		input[type="submit"]:hover {
			background-color: #3E8E41;
		}

		.logo img {
			height: 100px;
			margin-right: 10px;
			vertical-align: middle;
		}
	</style>
</head>
<body>
	<h1>Player Status Recording Form</h1>
	<form action="player_status.php" method="POST">
		<div class="logo"><img src="FAM.png" alt="Logo"></div>
		<label>Player ID:</label>
		<input type="text" name="player_id" required>

		<label>First Name:</label>
		<input type="text" name="fname" required>

		<label>Date of Birth:</label>
		<input type="date" name="dob" required>

		<label>Fitness Level:</label>
		<select name="fitness_level" required>
		    <option value="low">Low</option>
		    <option value="medium">Medium</option>
		    <option value="high">High</option>
		</select>

		<label>Injury History:</label>
		<input type="text" name="injury_history" required>

		<label>Rest Period (months):</label>
		<input type="number" name="rest_period" required>

		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fpms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into table
if(isset($_POST['submit'])) {
	$player_id = $_POST['player_id'];
	$fname = $_POST['fname'];
	$dob = $_POST['dob'];
	$fitness_level = $_POST['fitness_level'];
	$injury_history = $_POST['injury_history'];
	$rest_period = $_POST['rest_period'];

	$sql = "INSERT INTO player_status (player_id, fname, dob, fitness_level, injury_history, rest_period)
	VALUES ('$player_id', '$fname', '$dob', '$fitness_level', '$injury_history', '$rest_period')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}
?>