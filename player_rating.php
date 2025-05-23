
<!DOCTYPE html>
<html>
<head>
	<title>Player Rating</title>
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
			box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
		}

		label {
			display: block;
			margin-top: 10px;
			margin-bottom: 5px;
			font-weight: bold;
		}

		input[type="number"] {
			width: 50px;
		}

		input[type="text"],
		input[type="number"] {
			box-sizing: border-box;
			padding: 10px;
			border-radius: 5px;
			border: none;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
			width: 100%;
			margin-top: 5px;
			margin-bottom: 10px;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			font-weight: bold;
			cursor: pointer;
			transition: background-color 0.3s;
			margin-top: 10px;
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
	<h1>Player Rating Recording Form</h1>
	<form action="player_rating.php" method="POST">
		<div class="logo"><img src="FAM.png" alt="Logo"></div>
		<label>Player ID:</label>
		<input type="text" name="player_id" required>

		<label>First Name:</label>
		<input type="text" name="fname" required>

		<label>Date of Birth:</label>
		<input type="date" name="dob" required>

		<label>Tactical Skills (out of 10):</label>
		<input type="number" name="tactical_skills" min="1" max="10" required>

		<label>Tactical Awareness (out of 10):</label>
		<input type="number" name="tactical_awareness" min="1" max="10" required>

		<label>Physical Fitness (out of 10):</label>
		<input type="number" name="physical_fitness" min="1" max="10" required>

		<label>Commitment:</label>
		<input type="text" name="commitment" required>

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
	$tactical_skills = $_POST['tactical_skills'];
	$tactical_awareness = $_POST['tactical_awareness'];
	$physical_fitness = $_POST['physical_fitness'];
	$commitment = $_POST['commitment'];

	$sql = "INSERT INTO player_rating (player_id, fname, dob, tactical_skills, tactical_awareness, physical_fitness, commitment)
	VALUES ('$player_id', '$fname', '$dob', '$tactical_skills', '$tactical_awareness', '$physical_fitness', '$commitment')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}
?>