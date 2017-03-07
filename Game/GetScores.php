<?php
require_once '../functions.php';

$result = queryMysql('SELECT * FROM scores oRDER BY score LIMIT 10');

$rows = array();

while($row = $result->fetch_assoc()){
    $rows[] = $row;
}

echo json_encode($rows);