<?php
include('../db/db.php');

if (isset($_POST['delitmID'])) {

$item = preg_replace("/[^0-9]/i", "", $_POST['delitmID']);
$item = $db->real_escape_string($item);

$sql = <<<SQL
DELETE FROM tbllistitems WHERE item_id = '$item';
SQL;

if(!$result = $db->multi_query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

}
?>
