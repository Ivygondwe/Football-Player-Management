
<!DOCTYPE html>
<html>
<head>
	<title>Player Ratings</title>
	<style>
		table {
			margin: auto;
			border-collapse: collapse;
			width: 80%;
		}
		th, td {
			text-align: center;
			border: 1px solid black;
			padding: 8px;
		}
		.logo {
			float: left;
			width: 150px;
			height: 100px;
			margin: 10px;
		}
		.header {
			text-align: center;
			margin: 20px;
		}
		.home-link {
			float: left;
			margin: 20px;
		}
		.search {
			float: right;
			margin: 20px;
		}
	</style>
</head>
<body>
	<img class="logo" src="FAM.png">
	<div class="header">
		<h1>Player Ratings</h1>
		<h3>Check out our list of top-rated players</h3>
	</div>
	<div class="home-link">
		<a href="Admin_dashboad.html">Home</a>
	</div>
	<div class="search">
		<form action="" method="POST">
			<label for="fname">Search by First Name:</label>
			<input type="text" name="fname" id="fname">
			<input type="submit" name="search" value="Search">
		</form>
	</div>
	<table>
		<thead>
			<tr>
				<th>Player ID</th>
				<th>First Name</th>
				<th>Date of Birth</th>
				<th>Tactical Skills (out of 10)</th>
				<th>Tactical Awareness (out of 10)</th>
				<th>Physical Fitness (out of 10)</th>
				<th>Commitment</th>
			</tr>
		</thead>
		<tbody>
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

			// Retrieve data from table
			$sql = "SELECT * FROM player_rating";
			if(isset($_POST['search'])) {
				$fname = $_POST['fname'];
				$sql .= " WHERE fname LIKE '%$fname%'";
			}
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
			        echo "<tr><td>" . $row["player_id"]. "</td><td>" . $row["fname"]. "</td><td>" . $row["dob"]. "</td><td>" . $row["tactical_skills"]. "</td><td>" . $row["tactical_awareness"]. "</td><td>" . $row["physical_fitness"]. "</td><td>" . $row["commitment"]. "</td></tr>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();
			?>
		</tbody>
	</table>
</body>
</html>

