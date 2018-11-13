<?php 

session_start();

if(isset($_POST['submit'])){
    include_once 'dbh.inc.php';
    $first = mysqli_real_escape_string($conn,$_POST['first']);
    $last = mysqli_real_escape_string($conn,$_POST['last']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $uid = mysqli_real_escape_string($conn,$_POST['uid']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
    if(empty($uid)||empty($pwd)){
       
        header("Location: ../signup.php?signup=empty");
        exit();
    }else {
    
        $sql = "SELECT * FROM users WHERE user_uid='$uid'";
        $result = mysqli_query($conn,$sql);
        
        $resultCheck = mysqli_num_rows($result);
        
        if($resultCheck > 0 ){
            header("Location: ../signup.php?signup=usertaken");
            exit(); 
        }else {
            //hashing the password
            $hashedPWD = password_hash($pwd,PASSWORD_DEFAULT);
            
            //insert the user into the database
            $sql = "INSERT INTO users (user_first,user_last
                ,user_email,user_uid,user_pwd) VALUEs ('$first',
                '$last','$email','$uid','$hashedPWD')";
            $result = mysqli_query($conn,$sql);
            $_SESSION['username'] = $uid;
            header("Location: ../signupSuccess.php");
            exit();
            
        }
    }
}else{
    header("Location: ../signup.php");
    exit();
}

