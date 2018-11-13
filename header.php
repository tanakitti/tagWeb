<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/mystyles.css">
    <title>AlgoEvo</title>
</head>
<body>


            <nav class="navbar navbar-dark bg-dark">
                <div class="container">
                    <div class="logo">
                        <a class="navbar-brand" href="index.php">
                        AlgoEvo
                        </a>
                    </div>
                    <div class="login">
                        <?php 
                            if(isset($_SESSION['u_id'])){
                                echo    '<form action ="./includes/logout.inc.php" class ="login-form" method="POST">
                                <button type="submit" name="submit" class="btn btn-danger" >Logout</button>
                                </form>';
                            } else {
                                echo    '<form action="includes/login.inc.php" class ="login-form" method = "POST" >
                                <input type="text" name="uid" placeholder="Username" class="form-control">
                                <input type="password" name="pwd" placeholder="password" class="form-control">
                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                                <a href="signup.php" class = "btn btn-info">signup</a>
                                </form>
                                ';
                            }
                        ?>
                    </div>
                </div>          
            </nav>  