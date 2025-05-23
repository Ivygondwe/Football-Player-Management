
<!DOCTYPE html>
<html>
<head>
    <title>Player Medical Report List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .header {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            background-color: #4CAF50;
            padding: 16px;
        }

        .logo {
            width: 100px;
            height: 100px;
        }

        .search {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 16px;
        }

        .search input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: none;
            background-color: #f2f2f2;
        }

        .search input[type="submit"] {
            margin-left: 8px;
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="FAM.png" alt="Logo" class="logo">
    
        <h2 style="color: white; margin-left: 16px; text-align: center;">Player Medical Report List</h2>
        
    </div>

    <div class="search">
        <form method="get">
            <input type="text" name="player_name" placeholder="Enter player name">
            <input type="submit" value="Search">
        </form>
    </div>

    <?php
    // Define database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "fpms";

    // Create a connection to the database
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Handle form submission to update a medical report
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $doctor_id = mysqli_real_escape_string($conn, $_POST["doctor_id"]);
        $player_id = mysqli_real_escape_string($conn, $_POST["player_id"]);
        $player_name = mysqli_real_escape_string($conn, $_POST["player_name"]);
        $date_of_birth = mysqli_real_escape_string($conn, $_POST["date_of_birth"]);
        $medical_history = mysqli_real_escape_string($conn, $_POST["medical_history"]);
        $current_medication = mysqli_real_escape_string($conn, $_POST["current_medication"]);
        $examination_results = mysqli_real_escape_string($conn, $_POST["examination_results"]);
        $recommendation = mysqli_real_escape_string($conn, $_POST["recommendation"]);

        $sql = "UPDATE player_medical_report SET doctor_id='$doctor_id', player_id='$player_id', Fname='$player_name', dob='$date_of_birth', medical_history='$medical_history', current_medication='$current_medication', examination_results='$examination_results', recommendation='$recommendation' WHERE doctor_id='$doctor_id'";

        if (mysqli_query($conn, $sql)) {
            echo "Medical report updated successfully.";
        } else {
            echo "Error updating medical report: " . mysqli_error($conn);
        }
    }

    // Retrieve the data from the database
    if (isset($_GET["player_name"])) {
        $player_name = mysqli_real_escape_string($conn, $_GET["player_name"]);
        $sql = "SELECT * FROM player_medical_report WHERE Fname LIKE '%$player_name%'";
    } else {
        $sql = "SELECT * FROM player_medical_report";
    }

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . $sql . "<br>" . mysqli_error($conn));
    }

    // Display the data in a table
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Doctor ID</th><th>Player ID</th><th>Player Name</th><th>Date of Birth</th><th>Medical History</th><th>Current Medication</th><th>Examination Results</th><th>Recommendation</th><th>Action</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<form method='post'>";
           
            
            echo "<td><input type='text' name='doctor_id' value='" . $row["doctor_id"] . "'></td>";
            echo "<td><input type='text' name='player_id' value='" . $row["player_id"] . "'></td>";
            echo "<td><input type='text' name='player_name' value='" . $row["Fname"] . "'></td>";
            echo "<td><input type='date' name='date_of_birth' value='" . $row["dob"] . "'></td>";
            echo "<td><textarea name='medical_history'>" . $row["medical_history"] . "</textarea></td>";
            echo "<td><textarea name='current_medication'>" . $row["current_medication"] . "</textarea></td>";
            echo "<td><textarea name='examination_results'>" . $row["examination_results"] . "</textarea></td>";
            echo "<td><textarea name='recommendation'>" . $row["recommendation"] . "</textarea></td>";
            echo "<td><input type='submit' value='Update'></td>";
            echo "</form>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>