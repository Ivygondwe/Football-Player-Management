HTML code:

<!DOCTYPE html>
<html>
<head>
	<title>Physical Report Form</title>
</head>
<body>
	<h1>Player Physical Report</h1>
	<form action="player_physica_report.php" method="POST">
		<label>Player ID:</label>
		<input type="text" name="player_id"><br><br>

		<label>First Name:</label>
		<input type="text" name="fname"><br><br>

		<label>Date of Birth:</label>
		<input type="date" name="dob"><br><br>

		<label>Height (in cm):</label>
		<input type="number" name="height"><br><br>

		<label>Weight (in kg):</label>
		<input type="number" name="weight"><br><br>

		<label>Physical Performance:</label>
		<textarea name="physical_performance" rows="5" cols="30"></textarea><br><br>

		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>

PHP code (insert.php):

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
	$height = $_POST['height'];
	$weight = $_POST['weight'];
	$physical_performance = $_POST['physical_performance'];

	$sql = "INSERT INTO player_physical_report (player_id, fname, dob, height, weight, physical_performance)
	VALUES ('$player_id', '$fname', '$dob', '$height', '$weight', '$physical_performance')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}
?>