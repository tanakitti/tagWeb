<?php 

    include_once 'header.php';
    $url = $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    $message="";
    if($query['signup']=='empty')$message = "Please fill username or password.";
    else if($query['signup']=='usertaken')$message = "This username have been used.";
    if($message!=""){
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    
?>

        <div class="body">
            <div class="container ">
                <div class="col-lg-8 mx-auto">
                    <h2 class="topic">Signup</h2>
                    <form action="includes/signup.inc.php"  method="POST" class="register-form">
                    <div>
                        Username:<span style="color:red;"><b>*</b></span><input type="text" name="uid" placeholder="Username" class="form-control" required>
                    </div>
                    <div>
                        Password:<span style="color:red;"><b>*</b></span><input type="password" name="pwd" placeholder="Password" class="form-control" required>
                    </div>
                    <div>
                        Firstname:<input type="text" name="first" placeholder="Firstname" class="form-control first">
                    </div>
                    <div>
                        Lastname:<input type="text" name="last" placeholder="Lastname" class="form-control last">
                    </div>
                    <div>
                        Email:<input type="text" name="email" placeholder="E-mail" class="form-control email">
                    </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Sign up</button>
                    </form> 
                </div>
            </div>
        </div>
        
<script>
// function myFunctionName(){
//     var regex = /^[a-zA-Z\\s]*$/;
//     var first = $(".first").val();
//     var last = $(".last").val();
//     var email = $(".email").val();
//     if (!regex.test(first)) {
//         alert("Invalid Firstname, Special characters & number are not allowed");
//         return false;
//     }
//     if (!regex.test(last)) {
//         alert("Invalid Lastname, Special characters & number are not allowed");
//         return false;
//     }
//     return true;
// }

</script>
<?php 
    include_once 'footer.php';
?>
