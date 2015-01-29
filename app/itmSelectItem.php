<?php
include('../db/db.php');

$encode = array();

if (isset($_GET['grp'])) {

$list = preg_replace("/[^0-9]/i", "", $_GET['grp']);
$list = $db->real_escape_string($list);

$sql = <<<SQL
SELECT * FROM tblListItems WHERE lst_id = '$list 'ORDER BY color ASC, created DESC
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = mysqli_fetch_assoc($result)) {
   $encode[] = $row;
}


echo json_encode($encode);

}
?>