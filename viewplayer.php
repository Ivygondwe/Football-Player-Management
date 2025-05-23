
<!DOCTYPE html>
<html>
<head>
  <title>Players List</title>
  <style>
    body {
      background-color: #efefef;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #ffffff;
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
    table {
      border-collapse: collapse;
      margin: 50px auto;
      background-color: #ffffff;
      box-shadow: 0 0 10px #cccccc;
    }
    th, td {
      border: 1px solid black;
      padding: 5px;
    }
    #searchForm {
      margin-top: 20px;
      width: 100%;
      display: flex;
      justify-content: center;
    }
    #search {
      flex-grow: 1;
      padding: 10px;
      border: none;
      border-radius: 3px;
      box-shadow: 0 0 3px #cccccc;
      background-color: #f5f5f5;
    }
    #search:focus {
      outline: none;
      box-shadow: 0 0 3px #009933;
    }
    #searchBtn {
      padding: 10px;
      margin-left: 10px;
      background-color: #009933;
      color: #ffffff;
      border: none;
      border-radius: 3px;
      box-shadow: 0 0 3px #cccccc;
      cursor: pointer;
    }
    #searchBtn:hover {
      background-color: #007722;
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="header__logo">
      <img src="FAM.png" alt="Logo">
    </div>
    <h2 class="header__title">Player List</h2>
    <a href="Admin_dashboad.html" class="header__link">Home</a>
  </div>
  <?php
  $con = mysqli_connect("localhost", "root", "", "fpms");
  if(!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if(isset($_POST['searchBtn'])) {
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $search = mysqli_real_escape_string($con, $search);

    $sql = "SELECT * FROM players WHERE fname LIKE '%$search%' OR sname LIKE '%$search%'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
      echo '<form method="post" id="searchForm">';
      echo '<input type="text" name="search" id="search" placeholder="Search by First Name or Last Name" value="' . htmlspecialchars($search) . '">';
      echo '<button type="submit" name="searchBtn" id="searchBtn">Search</button>';
      echo '</form>';
      echo '<table>';
      echo '<tr><th>Player ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Gender</th><th>Phone</th><th>Email</th><th>Username</th></tr>';
      while($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['player_id'] . '</td>';
        echo '<td>' . $row['fname'] . '</td>';
        echo '<td>' . $row['sname'] . '</td>';
        echo '<td>' . $row['dob'] . '</td>';
        echo '<td>' . $row['gender'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>' . $row['Email'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '</tr>';
      }
      echo '</table>';
    } else {
      echo '<form method="post" id="searchForm">';
      echo '<input type="text" name="search" id="search" placeholder="Search by First Name or Last Name" value="' . htmlspecialchars($search) . '">';
      echo '<button type="submit" name="searchBtn" id="searchBtn">Search</button>';
      echo '</form>';
      echo '<p>No player records found.</p>';
    }
  } else {
    echo '<form method="post" id="searchForm">';
    echo '<button type="submit" name="searchBtn" id="searchBtn">Search</button>';
    echo '</form>';
    $sql = "SELECT * FROM players";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
      echo '<table>';
      echo '<tr><th>Player ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Gender</th><th>Phone</th><th>Email</th><th>Username</th></tr>';
      while($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['player_id'] . '</td>';
        echo '<td>' . $row['fname'] . '</td>';
        echo '<td>' . $row['sname'] . '</td>';
        echo '<td>' . $row['dob'] . '</td>';
        echo '<td>' . $row['gender'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>' . $row['Email'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '</tr>';
      }
      echo '</table>';
    } else {
      echo '<p>No player records found.</p>';
    }
  }

  mysqli_close($con);
  ?>
</body>
</html>
