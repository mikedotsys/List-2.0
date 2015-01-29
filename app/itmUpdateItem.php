<?php
include('../db/db.php');

if (isset($_POST['rename'], $_POST['lstID'])) {

$word = preg_replace("/[^a-z0-9-_!#?$&().,'\" ]/i", "", $_POST['rename']);
$item = preg_replace("/[^0-9]/i", "", $_POST['lstID']);
$word = $db->real_escape_string($word);
$item = $db->real_escape_string($item);

if (strpos($word,'_') !== false) {
	$color = 1;
} else {
	$color = 0;
}

$sql = <<<SQL
UPDATE tbllistitems SET name = '$word', color = '$color' WHERE item_id = '$item';
SQL;

	if(!$result = $db->query($sql)){
	    die('There was an error running the query [' . $db->error . ']');
	}

$sql = <<<SQL
SELECT * FROM tbllistitems where item_id ='$item'
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = mysqli_fetch_assoc($result)) {

echo json_encode($row);

}
}
?>