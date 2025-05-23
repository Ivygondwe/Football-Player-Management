<?php
$con=mysqli_connect('localhost','root','','fpms');

        // Check connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
  ?>