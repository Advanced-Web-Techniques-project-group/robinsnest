<?php // Example 26-11: messages.php
require_once 'header.php';

if (!$loggedin) die();

?>

<div class='main'>
    <h3>3D Halma</h3>

    <button onclick="sendScoreToServer()">Go</button>

    <div id="game-container"></div>
    <p id="score">Score: <span id="score-value">0</span></p>
    <div id="high-scores-container">
        <h2>High Scores</h2>
        <table id="high-scores">
            <tr>
                <th class="high-scores-country"></th>
                <th class="high-scores-name">Name</th>
                <th class="high-scores-score">Score</th>
                <th class="high-scores-date">Date</th>
            </tr>
            <tr>
                <td><img src="http://www.geognos.com/api/en/countries/flag/GR.png" class="game-flag"></td>
                <td>Karl Green</td>
                <td>39</td>
                <td>21-Feb-2017</td>
            </tr>
            <tr>
                <td><img src="http://www.geognos.com/api/en/countries/flag/AD.png" class="game-flag"></td>
                <td>Adam Pooley</td>
                <td>43</td>
                <td>21-Feb-2017</td>
            </tr>
            <tr>
                <td><img src="http://www.geognos.com/api/en/countries/flag/TO.png" class="game-flag"></td>
                <td>Tom Wilkinson</td>
                <td>46</td>
                <td>22-Feb-2017</td>
            </tr>
            <tr>
                <td><img src="http://www.geognos.com/api/en/countries/flag/RO.png" class="game-flag"></td>
                <td>Nicholas Roberts</td>
                <td>46</td>
                <td>23-Feb-2017</td>
            </tr>
        </table>
    </div>


    <!-- three.js -->
    <script src="Game/js/threeJs/three.min.js"></script>
    <script src="Game/js/threeJs/DragControls.js"></script>
    <script src="Game/js/threeJs/OrbitControls.js"></script>

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
</div>
</body>
</html>
