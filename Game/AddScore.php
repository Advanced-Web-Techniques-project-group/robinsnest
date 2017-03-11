<?php
session_start();

if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];
} else {
    die('Not logged in');
}

$score = 0;
if (isset($_POST['score']) && $_POST['score'] > 10) {
    $score = $_POST['score'];
} else {
    die('Bad score');
}

require_once '../functions.php';

$sql = "INSERT INTO scores (UserId, Score) VALUES ('$userId', '$score')";

queryMysql($sql);