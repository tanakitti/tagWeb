<?php 
include_once 'header.php';
session_start();
$username = $_SESSION['username'];
unset($_SESSION['username']);

if($username=="") {
    header("Location: ./index.php");
}
?>

<div class="body center">

    <div class="container">
        <div class="middle"> 
            <h1>Thank you " <?php echo $username ?> " </h1>
            <h4>You are successfully registered.</h4>
            <h4>Please login again using username " <?php echo $username ?> " and your registered password</h4>
            <a class="btn btn-primary" href="index.php" role="button">Home</a>
        </div>
    </div>
   
</div>

<?php 
include_once 'footer.php';
?>