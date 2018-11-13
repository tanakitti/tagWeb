<?php 



    include_once 'includes/func.inc.php';
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
    $sql = "SELECT marked_citation,u.user_uid From (SELECT user_id,count(scc_id) as marked_citation FROM tag;ogs
    GROUP BY user_id
    ORDER BY marked_citation DESC) r
    LEFT JOIN users u ON r.user_id = u.user_id";

    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
?>

    <div class="container unfix">
        
        <h1 class="topic">Leaderboard</h1>
        <div class="row">
            <?php
            for($i = 0 ; $i < 3;$i++){
                $row = mysqli_fetch_assoc($result);
                $rank = getRankPic($row['marked_citation']);
                if($rank == 'chevron11' ){
                    if($i==1) $rank = 'chevron14';
                    else if($i==2) $rank = 'chevron13';
                    else $rank = 'chevron12';
                } 
                echo '  <div class="col-4">
                                <div class="top3">
                                    <div class=" '.$rank.' top3-profile"></div>
                                    <div class="top3-order">Rank: '.($i+1).'</div>
                                    <div class="top3-detail">'.$row['user_uid'].'</div>
                                    <div class="top3-score">
                                        <div class="point">'.($row['marked_citation']*10).'</div> 
                                        <div class="cystal"></div>
                                    </div>
                                </div>
                        </div>';
                
            }
                
            ?>
        </div>
        <div class ="row">
            <div class="col col-12 col-xl-8 ml-auto mr-auto">
            <?php
            for($i; $i < 15;$i++){
                $row = mysqli_fetch_assoc($result);
                echo '<div class="highscore row">
                <div class="profile"></div>
                <div class="order col-1">'.($i+1).'</div>
                <div class="detail col-6">'.$row['user_uid'].'</div>
                <div class="score">
                    <div class="point">'.($row['marked_citation']*10).'</div> 
                    <div class="cystal"></div>
                </div>
                </div>';
            }?>
            </div>
        </div>
    </div>
<?php include_once 'footer.php'?>