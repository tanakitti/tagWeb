<?php 
session_start();
include_once 'dbh.inc.php';
include_once 'func.inc.php';

$user_id = $_POST['u_id'];
$id = $_POST['id'];
$citation_id = $_POST['citation_id'];
$type = $_POST['type'];

$sql = "SELECT id FROM shuffleCitationContexts WHERE cc_id = $id ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$scc_id = $row['id'];

$sql = "INSERT INTO taglogs (user_id,scc_id,type) VALUES ($user_id,$scc_id,$type);";
$result = mysqli_query($conn,$sql);

$u_id = $_SESSION['u_id'];
$sql = "SELECT * 
FROM citationContexts 
WHERE id = (SELECT cc_id 
			FROM shuffleCitationContexts 
			WHERE id NOT IN (SELECT scc_id 
							FROM taglogs 
							WHERE user_id = $u_id 
							UNION 
							SELECT scc_id 
							FROM taglogs 
							GROUP BY scc_id 
							HAVING count(user_id) >= 3 
							UNION 
                            SELECT scc_id 
							FROM skips 
							WHERE user_id = $u_id) 
			ORDER BY id LIMIT 1)";
$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$citation_id = $row['citation_id'];
$context = $row['context'];
$context = allHighlight($context);
echo json_encode( array(
                'id' => $id,
                'citation_id' => $citation_id,
                'context' => $context
            ));


