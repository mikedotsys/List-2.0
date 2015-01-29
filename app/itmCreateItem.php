<?php
include('../db/db.php');

if (isset($_POST['add'], $_POST['listMember'])) {

$word = preg_replace("/[^a-z0-9-_!#?$&().,\"' ]/i", "", $_POST['add']);
$lstId = preg_replace("/[^0-9]/i", "", $_POST['listMember']);
$word = $db->real_escape_string($word);
$lstId = $db->real_escape_string($lstId);

$crtBy = 0;

if (strpos($word,'_') !== false) {
	$color = 1;
} else {
	$color = 0;
}

$sql = <<<SQL
INSERT INTO tblListItems (name, created_by, lst_id, color) VALUES ('$word','$crtBy','$lstId','$color')
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

$last_inserted_id=$db->insert_id;


$sql = <<<SQL
SELECT * FROM tblListItems where item_id ='$last_inserted_id'
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = mysqli_fetch_assoc($result)) {

echo json_encode($row);

}
}
?>