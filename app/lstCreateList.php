<?php
include('../db/db.php');

if (isset($_POST['add'])) {

$word = preg_replace("/[^a-z0-9-!#?$&().,\"' ]/i", "", $_POST['add']);
$word = $db->real_escape_string($word);

$crtBy = 0;

$sql = <<<SQL
INSERT INTO tblLists (name, created_by) VALUES ('$word','$crtBy')
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

$last_inserted_id=$db->insert_id;

$sql = <<<SQL
SELECT * FROM tblLists where cat_id ='$last_inserted_id'
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = mysqli_fetch_assoc($result)) {

echo json_encode($row);

}
}
?>