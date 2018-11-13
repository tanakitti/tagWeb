<?php 
include_once 'dbh.inc.php';
include_once 'func.inc.php';

$sql = "SELECT id FROM shuffleCitationContexts WHERE cc_id = $cc_id ";