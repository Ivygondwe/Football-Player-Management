
<!DOCTYPE html>
<html>
<head>
  <title>Add Player</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #ffffff;
      padding: 16px;
      box-shadow: 0 0 10px #cccccc;
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
      max-width: 500px;
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
    .form-field textarea {
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
    .form-field textarea:focus {
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
  </style>
</head>
<body>
  <div class="header">
    <div class="header__logo">
      <img src="FAM.png" alt="Logo">
    </div>
    <h1 class="header__title">Add Players</h1>
    <a href="Admin_dashboard.html" class="header__link">Home</a>
  </div>
  <div class="form-container">
    <h1>Add Player</h1>
    <form method="post">
      <div class="form-field">
        <label for="player_id">Player ID</label>
        <input type="text" name="player_id" id="player_id" required>
      </div>

      <div class="form-field">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" required>
      </div>

      <div class="form-field">
        <label for="sname">Last Name</label>
        <input type="text" name="sname" id="sname" required>
      </div>

      <div class="form-field">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" id="dob" required>
      </div>

      <div class="form-field">
        <label for="gender">Gender</label>
        <select name="gender" id="gender" required>
          <option value="">Choose Gender</option>
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select>
      </div>

      <div class="form-field">
        <label for="phone">Phone</label>
        <input type="tel" name="phone" id="phone" required>
      </div>

      <div class="form-field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </div>

      <div class="form-field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
      </div>

      <div class="form-field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
      </div>

      <div class="form-field">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
      </div>

      <div class="form-field">
        <input type="submit" name="submit" value="Add Player">
      </div>
    </form>
    <?php
    // Create database connection
    $con = mysqli_connect("localhost", "root", "", "fpms");
    if (!$con) {
      die("connection failed: " . mysqli_connect_error($con));
    }

    if (isset($_POST['submit'])) {
      // Get the input values from the form
      $player_id = mysqli_real_escape_string($con, $_POST['player_id']);
      $fname = mysqli_real_escape_string($con, $_POST['fname']);
      $sname = mysqli_real_escape_string($con, $_POST['sname']);
      $dob = mysqli_real_escape_string($con, $_POST['dob']);
      $gender = mysqli_real_escape_string($con, $_POST['gender']);
      $phone = mysqli_real_escape_string($con, $_POST['phone']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $username = mysqli_real_escape_string($con, $_POST['username']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
      $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
     

      // Check if the passwords match
      if ($password !== $confirm_password) {
        echo '<p style="color: red;">Error: Passwords do not match.</p>';
      } else {
        // Save the input data to the database
        $query = "INSERT INTO players (player_id, fname, sname, dob, gender, phone, email, username, password)
                  VALUES ('$player_id', '$fname', '$sname', '$dob', '$gender', '$phone', '$email', '$username', '$password')";
        if (mysqli_query($con, $query)) {
          echo '<script>alert("player added successfully!"); window.location="addplayer.php";</script>';
        } else {
          echo '<p style="color: red;">Error: ' . mysqli_error($con) . '</p>';
        }
      }
      // Close database connection
      mysqli_close($con);
    }
    ?>
  </div>
</body>
</html>
