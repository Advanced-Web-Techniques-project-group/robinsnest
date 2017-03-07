<?php
session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
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

queryMysql('INSERT INTO scores (UserId, Score, Longitude, Latitude) VALUES (1, ' . $score . ', '. 1.1111 . ', ' . 1.1111 . ')');