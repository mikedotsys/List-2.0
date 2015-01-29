<?php
include('../db/db.php');

if (isset($_POST['rename'], $_POST['lstID'])) {

$word = preg_replace("/[^a-z0-9-!#?$&().,\"' ]/i", "", $_POST['rename']);
$item = preg_replace("/[^0-9]/i", "", $_POST['lstID']);
$word = $db->real_escape_string($word);
$item = $db->real_escape_string($item);

$sql = <<<SQL
UPDATE tblLists SET name = '$word' WHERE cat_id = '$item';
SQL;

	if(!$result = $db->query($sql)){
	    die('There was an error running the query [' . $db->error . ']');
	}

$sql = <<<SQL
SELECT name, cat_id, (SELECT COUNT(*) FROM tbllistitems
    WHERE tbllistitems.lst_id = '$item')
    AS total_records FROM tblLists WHERE cat_id = '$item'
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = mysqli_fetch_assoc($result)) {

echo json_encode($row);

}

}
?>