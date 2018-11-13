<?php 
session_start();
include_once 'dbh.inc.php';

$citation_id = $_POST['citation_id'];

$sql = "SELECT authors,title,year,paperid FROM citations WHERE id = $citation_id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$title = $row['title'];
$authors = $row['authors'];
$year = $row['year'];
$paperid =  $row['paperid'];

$sql = "SELECT abstract,title,year FROM papers WHERE id = '$paperid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$abstract = $row['abstract'];
$title2 = $row['title'];
$year2 = $row['year'];

echo json_encode( array(
    'title' => $title,
    'author' => $authors,
    'year' => $year,
    'abstract' =>$abstract,
    'title2' => $title2,
    'year2' => $year2
));


