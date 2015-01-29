<?php
include('../db/db.php');

$encode = array();

$sql = <<<SQL
SELECT name, cat_id, (SELECT COUNT(*) FROM tbllistitems
    WHERE tbllistitems.lst_id = tbllists.cat_id)
    AS total_rec
    FROM tbllists ORDER BY total_records DESC, updated_date DESC, created_date DESC
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = mysqli_fetch_assoc($result)) {
   $encode[] = $row;
}

echo json_encode($encode);

?>