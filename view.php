
<!DOCTYPE html>
<html>
<head>
    <title>Player Medical Report List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 80%;
            max-width: 800px;
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

        .logo img {
            height: 100px;
            margin-right: 10px;
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

        h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo"><img src="FAM.png" alt="Logo"></div>
        <h2 style="color: white; margin-left: 16px;">Player Medical Report List</h2>

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
        echo "<tr><th>Doctor ID</th><th>Player ID</th><th>Player Name</th><th>Date of Birth</th><th>Medical History</th><th>Current Medication</th><th>Examination Results</th><th>Recommendation</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";

            echo "<td>" . $row["doctor_id"] . "</td>";
            echo "<td>" . $row["player_id"] . "</td>";
            echo "<td>" . $row["Fname"] . "</td>";
            echo "<td>" . $row["dob"] . "</td>";
            echo "<td>" . $row["medical_history"] . "</td>";
            echo "<td>" . $row["current_medication"] . "</td>";
            echo "<td>" . $row["examination_results"] . "</td>";
            echo "<td>" . $row["recommendation"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No records found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
