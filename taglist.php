<?php 
include_once 'header.php';
include_once 'includes/func.inc.php';
include_once 'includes/dbh.inc.php';

$sql = "SELECT *
FROM taglogs
LEFT JOIN shuffleCitationContexts ON shuffleCitationContexts.id = taglogs.`scc_id`
LEFT JOIN users ON users.user_id = taglogs.user_id
LEFT JOIN citationContexts ON citationContexts.id = shuffleCitationContexts.`cc_id`
ORDER BY shuffleCitationContexts.id";

$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);


?>

<div class="body">
    <div class="container">
    <h1 class="topic">Tagging Result</h1>
        <div class="row" style="justify-content:  center;margin-top: 40px;" >
    <?php 
    
if($resultCheck>0){
    
    while($row = mysqli_fetch_assoc($result)){
        $a[$row['scc_id']][$row['cc_id']][$row['citation_id']][$row['context']][] = $row['user_uid'];
        $type[$row['scc_id']][$row['type']] += 1;
    }

    
    $comp = 0;
    $Consensus = 0;
    $incomp = 0;
    foreach ($a as $scc_id => $rows){     
        foreach($rows as $cc_id => $rows2){       
            foreach($rows2 as $citation_id => $rows3){
                foreach($rows3 as $context => $rows4){
                        if(sizeof($a[$scc_id][$cc_id][$citation_id][$context]) == 3) {
                            $comp += 1 ; 
                            $max = max($type[$scc_id][1],$type[$scc_id][2],$type[$scc_id][3],$type[$scc_id][4]);
                            $dup = 0;
                            for($i = 1;$i<=4;$i++){
                                if($type[$scc_id][$i] == $max){
                                    $dup +=1;
                                }
                            }
                            if($dup==1)$Consensus +=1;
                        }else{
                            $incomp+=1;
                        }
                }           
            }         
        }      
    }
    $sql2 = "SELECT COUNT(*) as size FROM shuffleCitationContexts";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $resultCheck2 = mysqli_num_rows($result2);
    $sizeOfTable = $row2['size'];

    echo "<div class='topic-taglist' style='display:flex;'><div class='listtag'>Complete: </div>".$comp." <div class='listtag'>Consensus: </div>".$Consensus." <div class='listtag'>Incomplete: </div>".$incomp." <div class='listtag'>Total: </div>".$sizeOfTable."</div>";
    echo "<table class='table table-bordered'>";
    echo "<tr> <td>No</td><td>cc_id</td><td>citation_id</td><td>USE</td><td>EXTEND</td><td>MENTION</td><td>NOTALGO</td><td>CitationContext</td><td>Taggers</td></tr>";
    foreach ($a as $scc_id => $rows){
        echo " <tr> <td>".$scc_id."</td>";
        foreach($rows as $cc_id => $rows2){
            echo "<td>".$cc_id."<br>"."</td>";
            foreach($rows2 as $citation_id => $rows3){
                echo "<td>".$citation_id."</td>";

                echo "<td>";
                if(isset($type[$scc_id][1])) echo $type[$scc_id][1];
                else echo 0;
                echo "</td>";

                echo "<td>";
                if(isset($type[$scc_id][2])) echo $type[$scc_id][2];
                else echo 0;
                echo "</td>";

                echo "<td>";
                if(isset($type[$scc_id][3])) echo $type[$scc_id][3];
                else echo 0;
                echo "</td>";

                echo "<td>";
                if(isset($type[$scc_id][4])) echo $type[$scc_id][4];
                else echo 0;
                echo "</td>";

                foreach($rows3 as $context => $rows4){
                    echo "<td>".$context."</td>"."<td>";
                    foreach($rows4 as $user_uid ){
                        echo $user_uid."<br>";
                    }
                    echo "</td>";
                }
                
            } 
           
        }
        echo "<tr>";
    }
    echo "</table>";
}
?>
    </div>
    </div>



</div>



<?php include_once 'footer.php'?>
