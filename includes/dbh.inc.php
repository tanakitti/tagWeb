<?php

$dbSevername = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbName = "algoEvo";

$conn = mysqli_connect($dbSevername,$dbUsername,$dbPassword,$dbName);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


  