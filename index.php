<?php include_once 'header.php'?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="cover-list">
                <?php if(isset($_SESSION['u_id'])){
                echo "<h1>Will you <b>\"Start\"</b> or <b>\"Tutorial\"</b>? </h1>
                <a href='start.php' class='cover-link'>Start</a>
                <a href='toturial.php' class='cover-link'>Toturial</a>
                <a href='ranking.php' class='cover-link'>Leaderboard</a>
                <a href='about.php' class='cover-link'>About us</a>
                <a href='taglist.php' class = 'cover-link'>Tagging Result</a>";  
                  
            }else {
                echo " <h1>Please Login First</h1>
                <a href='toturial.php' class='cover-link'>Toturial</a>
                <a href='about.php' class='cover-link'>About us</a>";
            }
            ?>
                </div>
            </div>
            <div class="cover col">
            </div> 
        </div>
    </div>

    <?php include_once 'footer.php'?>