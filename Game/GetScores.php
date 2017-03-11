<?php
require_once '../functions.php';

$sql = "select concat(m.FirstName, ' ', m.LastName) as 'Name', s.Score, s.DateCreated, m.Country from scores s inner join members m on s.UserId = m.UserId";

$result = queryMysql($sql);

$rows = array();

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode($rows);