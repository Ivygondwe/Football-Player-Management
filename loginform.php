
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <title>FPMS LoginForm</title>

  <script>
    function f1() {
      var sta2 = document.getElementById("exampleInputUsername").value.trim();
      var sta3 = document.getElementById("exampleInputPassword").value.trim();
      if (sta2.indexOf(' ') >= 0) {
        document.getElementById("exampleInputUsername").value = "";
        document.getElementById("exampleInputUsername").focus();
        alert("Space Not Allowed");
      } else if (sta3.indexOf(' ') >= 0) {
        document.getElementById("exampleInputPassword").value = "";
        document.getElementById("exampleInputPassword").focus();
        alert("Space Not Allowed");
      }
    }
  </script>

  <style>
    body {
      background-color: #F2F2F2;
      color: black;
    }
    
    .log-section {
      background-color: #254d77;
      color: #fff;
      height: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 1.5rem;
      font-weight: bold;
    }
    
    .logo {
      position: absolute;
      top: 10px;
      left: 10px;
      width: 50px;
      height: 50px;
    }
    
    .log-form {
      margin: auto;
      width: 30%;
      margin-top: 5rem;
      background-color: #f7f7f7;
      border-radius: 5px;
      box-shadow: 0 0 10px #ccc;
      padding: 20px;
      position: relative;
    }
    
    .log-form h1 {
      color: #254d77;
      font-size: 2rem;
      margin-bottom: 2rem;
    }
  </style>
</head>

<body>
  <div class="log-section">
    <p>Football Player Monitoring System</p>
  </div>

  <div class="log-form">
    <img class="logo" src="FAM.png" alt="Logo"> <!-- Logo added to the top left corner of the form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <h1>Football Player Monitoring System Login</h1>
      <div class="form-group">
        <label for="exampleInputUsername"><strong>Username</strong></label>
        <input type="text" name="username" class="form-control" id="exampleInputUsername" placeholder="Enter username" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword"><strong>Password</strong></label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Enter password" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
    </form>
  </div>

  <div style="position: fixed; left: 0; bottom: 0; width: 100%; height: 30px; background-color: rgba(0,0,0,0.8); color: white; text-align: center;">
    <h4>&copy; <b>FPMS 2023</b></h4>
  </div>
</body>

</html>
<?php 
include('connection.php');
session_start();
$errormsg="";
if(isset($_POST['submit']))
{
    if(empty($_POST['username']))
    {
        echo "<p style='margin-left:52%; color: red;'> enter username</p></br> ";
    }
    if(empty($_POST['password']))
    {
       echo "<p style='margin-left:52%; color: red;'> enter password</p></br> "; 
    }
    if (!empty($_POST['username']) && !empty($_POST['password'])) 
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        
        // Check if user is admin
        $select_admin="SELECT username, password FROM users WHERE username='$username' AND password='$password' AND acount_type='Adminstration'" ;
        $result_admin=mysqli_query($con, $select_admin);
        
        if($result_admin === false) {
            echo "Error: " . mysqli_error($con);
        }
        else {
            $row_admin=mysqli_fetch_array($result_admin);

            // Check if user is coach
            $select_coach="SELECT username, password FROM users WHERE username='$username' AND password='$password' AND acount_type='Coaching'" ;
            $result_coach=mysqli_query($con, $select_coach);

            if($result_coach === false) {
                echo "Error: " . mysqli_error($con);
            }
            else {
                $row_coach=mysqli_fetch_array($result_coach);

                // Check if user is medical personnel
                $select_medical="SELECT username, password FROM users WHERE username='$username' AND password='$password' AND acount_type='medical_personnel'" ;
                $result_medical=mysqli_query($con, $select_medical);

                if($result_medical === false) {
                    echo "Error: " . mysqli_error($con);
                }
                else {
                    $row_medical=mysqli_fetch_array($result_medical);

                    // Redirect user based on user type
                    if($row_admin['username']==$username && $row_admin['password']==$password)
                    {
                        header("location: admin_dashboad.html");
                    }
                    else if ($row_coach['username']==$username && $row_coach['password']==$password)
                    {
                        header("location: coach_dashboard.html");
                    }
                    else if ($row_medical['username']==$username && $row_medical['password']==$password)
                    {
                        header("location: medicalpersonnel_dashboard.html");
                    }
                    else
                    {
                        echo "<p style='margin-right:52%; color: red;'> invalid login </p></br> ";
                    }
                    mysqli_close($con);
                }
            }
        }
    }
}
?>
