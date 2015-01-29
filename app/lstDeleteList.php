<?php
error_reporting(E_ALL);
include('../db/db.php');

if (isset($_POST['dellstID'])) {

$list = preg_replace("/[^0-9]/i", "", $_POST['dellstID']);
$list = $db->real_escape_string($list);

$sql = <<<SQL
DELETE FROM tblLists WHERE cat_id = '$list';
SQL;

if(!$result = $db->multi_query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

}
?>
