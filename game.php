<?php
require_once 'header.php';

if (!$loggedin) die();
?>

<div class='main'>
    <h3>3D Halma</h3>

    <div id="game-container"></div>
    <p id="score">Score: <span id="score-value">0</span></p>
    <div id="high-scores-container">
        <h2>High Scores</h2>
        <table id="high-scores">

        </table>
    </div>

</div>

<!-- three.js -->
<script src="Game/js/threeJs/three.min.js"></script>
<script src="Game/js/threeJs/DragControls.js"></script>
<script src="Game/js/threeJs/OrbitControls.js"></script>
<script src="Game/js/threeJs/CanvasRenderer.js"></script>
<script src="Game/js/threeJs/Projector.js"></script>
<script src="Game/js/threeJs/Detector.js"></script>

<!-- Game-->
<script src="Game/js/3dGame.js"></script>
<link rel="stylesheet" href="Game/styles/game.css">

<!-- jQuery -->
<script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/sweetalert2/6.4.2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.4.2/sweetalert2.min.css">

<script>
    $(document).ready(function () {
        getHighScores();
    });
</script>

</body>
</html>
