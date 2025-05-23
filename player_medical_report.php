
<!DOCTYPE html>
<html>
<head>
    <title>Player Medical Report Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        form {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
            box-shadow: 0 0 10px #ccc;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo img {
            height: 100px;
            margin-right: 10px;
        }

        h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="logo"><img src="FAM.png" alt="Logo"></div>
        <h2>Player Medical Report Recording Form</h2>
        <label for="doctor_id">Doctor ID:</label>
        <input type="text" id="doctor_id" name="doctor_id" required><br><br>

        <label for="player_id">Player ID:</label>
        <input type="text" id="player_id" name="player_id" required><br><br>

        <label for="player_name">Player Name:</label>
        <input type="text" id="player_name" name="player_name" required><br><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

        <label for="medical_history">Medical History:</label>
        <textarea id="medical_history" name="medical_history" rows="5" cols="30"></textarea><br><br>

        <label for="current_medication">Current Medication:</label>
        <textarea id="current_medication" name="current_medication" rows="5" cols="30"></textarea><br><br>

        <label for="examination_results">Examination Results:</label>
        <textarea id="examination_results" name="examination_results" rows="5" cols="30"></textarea><br><br>

        <label for="recommendation">Recommendation:</label>
        <textarea id="recommendation" name="recommendation" rows="5" cols="30"></textarea><br><br>

        <input type="submit" value="Submit">
    </form>

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

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $doctor_id = mysqli_real_escape_string($conn, $_POST["doctor_id"]);
        $player_id = mysqli_real_escape_string($conn, $_POST["player_id"]);
        $player_name = mysqli_real_escape_string($conn, $_POST["player_name"]);
        $date_of_birth = mysqli_real_escape_string($conn, $_POST["date_of_birth"]);
        $medical_history = mysqli_real_escape_string($conn, $_POST["medical_history"]);
        $current_medication = mysqli_real_escape_string($conn, $_POST["current_medication"]);
        $examination_results = mysqli_real_escape_string($conn, $_POST["examination_results"]);
        $recommendation = mysqli_real_escape_string($conn, $_POST["recommendation"]);

        // Insert the data into the database
        $sql = "INSERT INTO player_medical_report (doctor_id, player_id, Fname, dob, medical_history, current_medication, examination_results, recommendation)
                VALUES ('$doctor_id', '$player_id', '$player_name', '$date_of_birth', '$medical_history', '$current_medication', '$examination_results', '$recommendation')";

        if (mysqli_query($conn, $sql)) {
            echo "Player medical report submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>

