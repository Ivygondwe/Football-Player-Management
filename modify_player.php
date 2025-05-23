<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modify Player</title>
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
      background-color: #f5f5f5;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #4CAF50;
      color: #ffffff;
      padding: 10px;
    }
    .header__logo img {
      height: 50px;
    }
    .header__link {
      font-size: 1.3rem;
      padding: 5px;
      color: #000000;
      text-decoration: none;
    }
    .header__title {
      font-size: 1.8rem;
      text-align: center;
      margin: 0;
    }
    .form-container {
      max-width: 800px;
      margin: 50px auto;
      padding: 32px;
      background-color: #ffffff;
      box-shadow: 0 0 10px #cccccc;
    }
    .form-container h1 {
      font-size: 2.4rem;
      margin-top: 0;
      margin-bottom: 32px;
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
    .form-field {
      margin-bottom: 16px;
    }
    .form-field label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      font-size: 1.2rem;
    }
    .form-field select,
    .form-field input[type=text],
    .form-field input[type=email],
    .form-field input[type=password],
    .form-field textarea,
    .form-field input[type=date] {
      display: block;
      width: 100%;
      padding: 8px;
      font-size: 1.2rem;
      border: 2px solid #e9e9e9;
      border-radius: 4px;
      box-shadow: 0 0 3px #cccccc;
      background-color: #f5f5f5;
      transition: border-color 0.3s ease-in-out;
    }
    .form-field select:focus,
    .form-field input:focus,
    .form-field textarea:focus,
    .form-field input[type=date]:focus {
      outline: none;
      border-color: #009933;
    }
    .form-field input[type=submit] {
      display: inline-block;
      margin-top: 24px;
      padding: 12px 24px;
      font-size: 1.2rem;
      color: #ffffff;
      background-color: #009933;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }
    .form-field input[type=submit]:hover {
      background-color: #007722;
    }
    .form-field input[type=button] {
      display: inline-block;
      margin-top: 24px;
      margin-right: 16px;
      padding: 12px 24px;
      font-size: 1.2rem;
      color: #ffffff;
      background-color: #b30000;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }
    .form-field input[type=button]:hover {
      background-color: #7f0000;
    }
  </style>
</head>
<body>
  <?php
    // Create database connection
    $con = mysqli_connect("localhost", "root", "", "fpms");
    if (!$con) {
      die("connection failed: " . mysqli_connect_error($con));
    }
  ?>
  <div class="header">
    <div class="header__logo">
      <img src="FAM.png" alt="Logo">
    </div>
    <h1 class="header__title">Modify Player</h1>
    <a href="Admin_dashboard.html" class="header__link"></a>
  </div>
  <div class="form-container">
    <h1>Search for Player</h1>
    <form method="get">
      <div class="form-field">
        <label for="player_name">Player Name</label>
        <input type="text" name="fname" id="fname" required>
        <label for="player_surname">Player Surname</label>
        <input type="text" name="sname" id="sname" required>
        <input type="submit" value="Search">
      </div>
    </form>
    <?php
    if (isset($_GET['fname'], $_GET['sname'])) {
      // Get the player's details from the database
      $fname = mysqli_real_escape_string($con, $_GET['fname']);
      $sname = mysqli_real_escape_string($con, $_GET['sname']);
      $query = "SELECT * FROM players WHERE fname LIKE '%$fname%' AND sname LIKE '%$sname%'";
      $result = mysqli_query($con, $query);

      if (!$result || mysqli_num_rows($result) == 0) {
        echo '<p style="color: red;">Error: Player not found.</p>';
      } else {
        // Display the player's details in a table
        echo '<form method="post">';
        echo '<table>';
        echo '<tr><th>Player ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Gender</th><th>Phone</th><th>Email</th><th>Username</th><th>Password</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $row['player_id'] . '</td>';
          echo '<td>' . $row['fname'] . '</td>';
          echo '<td>' . $row['sname'] . '</td>';
          echo '<td><input type="date" name="dob" value="' . $row['dob'] . '" required></td>';
          echo '<td><select name="gender" required>';
          if ($row['gender'] == 'M') {
            echo '<option value="M" selected>Male</option>';
            echo '<option value="F">Female</option>';
          } else {
            echo '<option value="M">Male</option>';
            echo '<option value="F" selected>Female</option>';
          }
          echo '</select></td>';
          echo '<td><input type="tel" name="phone" value="' . $row['phone'] . '" required></td>';
          echo '<td><input type="email" name="email" value="' . (isset($row['email']) ? $row['email'] : "") . '" required></td>';
          echo '<td><input type="text" name="username" value="' . $row['username'] . '" required></td>';
          echo '<td><input type="password" name="password" value="' . $row['password'] . '" required></td>';
          echo '</tr>';
        }
        echo '</table>';
        echo '<div class="form-field">';
        echo '<input type="button" onclick="window.location=\'modifyplayer.php\';" value="Cancel">';
        echo '<input type="submit" name="update" value="Update Player">';
        echo '</div>';
        echo '</form>';
      }
    }
    ?>
    <?php
    if (isset($_POST['update'])) {
      // Update the player's details in the database
      $player_id = mysqli_real_escape_string($con, $_POST['player_id']);
      $dob = mysqli_real_escape_string($con, $_POST['dob']);
      $gender = mysqli_real_escape_string($con, $_POST['gender']);
      $phone = mysqli_real_escape_string($con, $_POST['phone']);
      $username = mysqli_real_escape_string($con, $_POST['username']);
      $password = mysqli_real_escape_string($con, $_POST['password']);

      // Check if email and address are set
      $email = "";
      if (isset($_POST['email'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
      }

      $address = "";
      if (isset($_POST['address'])) {
        $address = mysqli_real_escape_string($con, $_POST['address']);
      }

      $query = "UPDATE players SET player_id='$player_id', dob='$dob', gender='$gender', phone='$phone', email='$email', username='$username', password='$password',  WHERE player_id='$player_id'";

      if (mysqli_query($con, $query)) {
        echo '<script>alert("Player updated successfully!"); window.location="modifyplayer.php";</script>';
      } else {
        echo '<p style="color: red;">Error: ' . mysqli_error($con) . '</p>';
      }
    }
    ?>
  </div>
</body>
</html>
