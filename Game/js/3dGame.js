const BOARD_WIDTH = 9;
const BOARD_HEIGHT = 9;
const COLOUR_HIGHLIGHTED_PIECE = 0xffff00;
const SIZE_TILE = 12;
const TYPE_BOARD_PIECE = "board-piece";
const TYPE_GAME_PIECE = "game-piece";

var board;
var container;
var camera, controls, renderer, scene;
var gameWindowHeight = 600;
var mouse = new THREE.Vector2();
var pieceIntersected, pieceSelected, pieceScoredThisTurn;
var raycaster = new THREE.Raycaster();
var score;
var colorGamePiece = 0xF44336;


function resetGame() {
    board = [
        [1, 1, 1, 0, 0, 0, 0, 0, 0],
        [1, 1, 1, 0, 0, 0, 0, 0, 0],
        [1, 1, 1, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0]
    ];
    score = 0;
    updateScoreDisplay();
    pieceScoredThisTurn = null;

    // The following three lines must be in this order to properly reset the game
    pieceSelected = null;
    restorePreviouslyIntersectedObjectToOriginalState();
    pieceIntersected = null;
}

function init(color) {
    container = document.getElementById('game-container');

    colorGamePiece = color;

    resetGame();
    setUpSceneAndLighting();
    setUpCamera();
    setUpCameraControls();
    drawBoard();
    drawGamePieces();
    setUpRenderer();

    container.addEventListener('mousemove', onMouseMove, false);
    container.addEventListener('mousedown', onMouseDown, false);
    container.addEventListener('resize', onWindowResize, false);
}

function onWindowResize() {
    camera.aspect = container.clientWidth / gameWindowHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(container.clientWidth, gameWindowHeight);
}

function animate() {
    requestAnimationFrame(animate);
    render();
}

function render() {
    controls.update();
    renderer.render(scene, camera);
}

function highlightIntersectedObject() {
    // Update the raycaster with the camera angle and mouse position
    raycaster.setFromCamera(mouse, camera);

    // Get objects that are intersected by the raycaster
    var intersects = raycaster.intersectObjects(scene.children);

    if (intersects.length > 0) {

        // Check there is a new object before updating it
        if (intersects[0].object != pieceIntersected) {
            restorePreviouslyIntersectedObjectToOriginalState();

            pieceIntersected = intersects[0].object;
            // Only highlight a tile if a game piece is selected
            if ((pieceIntersected.type === TYPE_BOARD_PIECE && pieceSelected !== null) || pieceIntersected.type === TYPE_GAME_PIECE) {
                // Store the objects colour so that it can be restored later
                pieceIntersected.currentHex = pieceIntersected.material.color.getHex();
                // Set a new colour
                pieceIntersected.material.color.setHex(COLOUR_HIGHLIGHTED_PIECE);
            } else {
                pieceIntersected = null;
            }
        }
    } else {
        restorePreviouslyIntersectedObjectToOriginalState();
    }
}

function restorePreviouslyIntersectedObjectToOriginalState() {
    // Restore old object to previous state, unless it is the selected game piece
    if (pieceIntersected !== undefined && pieceIntersected !== null) {
        if (pieceIntersected !== pieceSelected) {
            pieceIntersected.material.color.setHex(pieceIntersected.currentHex);
        }
    }
}

function onMouseMove(event) {
    // Update the mouse position
    var x = event.offsetX == undefined ? event.layerX : event.offsetX;
    var y = event.offsetY == undefined ? event.layerY : event.offsetY;
    mouse.x = ( x / renderer.domElement.width ) * 2 - 1;
    mouse.y = -( y / renderer.domElement.height ) * 2 + 1;
    highlightIntersectedObject();
}

function onMouseDown() {
    // Update the raycaster with the camera angle and mouse position
    raycaster.setFromCamera(mouse, camera);

    // Get objects that are intersected by the raycaster
    var intersects = raycaster.intersectObjects(scene.children);

    if (intersects.length > 0) {
        pieceIntersected = intersects[0].object;

        if (pieceIntersected.type === TYPE_GAME_PIECE) {
            // Restore previously selected piece's colour
            if (pieceSelected !== null) {
                pieceSelected.material.color = new THREE.Color(colorGamePiece);
            }

            // Update the new piece
            pieceSelected = pieceIntersected;
            pieceSelected.material.color.setHex(COLOUR_HIGHLIGHTED_PIECE);

        } else if (pieceIntersected.type === TYPE_BOARD_PIECE) {

            if (pieceSelected == null) {
                // Selected board piece without selecting a game piece
                return;
            }

            if (isMoveValid(pieceSelected, pieceIntersected)) {
                calculateScore(pieceSelected, pieceIntersected);
                movePiece(pieceSelected, pieceIntersected);
            }
        }
    }

    if (isGameOver()) {
        sendScoreToServer();
        swal(
            'Well Done!',
            'You completed the game with ' + score + ' points!',
            'success'
        );
        init(colorGamePiece);
    }
}

function sendScoreToServer() {
    $.ajax({
        method: 'POST',
        url: 'game/AddScore.php',
        dataType: 'json',
        data: {
            score: score
        },
        success: getHighScores()
    });
}

function isGameOver() {
    for (var column = 6; column < BOARD_WIDTH; column++) {
        for (var height = 6; height < BOARD_HEIGHT; height++) {
            if (board[column][height] !== 1) {
                return false;
            }
        }
    }
    return true;
}

function isMoveValid(selectedPiece, newPosition) {
    // Check if the new position is empty (this also checks if the position is different to the original)
    if (board[newPosition.row][newPosition.column] !== 0) {
        // Invalid move - New position already full
        return false;
    }

    // Used to check if the new position is legally reachable
    var differenceBetweenRows = Math.abs(selectedPiece.row - newPosition.row);
    var differenceBetweenColumns = Math.abs(selectedPiece.column - newPosition.column);

    // Check if jump is too far
    if (differenceBetweenRows > 2 || differenceBetweenColumns > 2) {
        // Invalid move - Distance too far
        return false;
    }

    // If moving more than one space away, check there is a piece to jump over
    if (differenceBetweenRows > 1 || differenceBetweenColumns > 1) {
        var rowBetween = (selectedPiece.row + newPosition.row) / 2;
        var columnBetween = (selectedPiece.column + newPosition.column) / 2;

        if (board[rowBetween][columnBetween] !== 1) {
            // Invalid move - Distance too far without a piece to jump over");
            return false;
        }

    }

    return true;
}

function movePiece(gamePiece, boardPiece) {
    // Update board object
    board[gamePiece.row][gamePiece.column] = 0;
    board[boardPiece.row][boardPiece.column] = 1;

    // Move physical position of the game piece
    gamePiece.position.x = boardPiece.position.x;
    gamePiece.position.z = boardPiece.position.z;

    // Update row and column of the game piece
    gamePiece.row = boardPiece.row;
    gamePiece.column = boardPiece.column;
}

function calculateScore(gamePiece, boardPiece) {
    var differenceBetweenRows = Math.abs(gamePiece.row - boardPiece.row);
    var differenceBetweenColumns = Math.abs(gamePiece.column - boardPiece.column);

    if (differenceBetweenRows <= 1 && differenceBetweenColumns <= 1) {
        // For a normal move, always increase the score
        score++;
        pieceScoredThisTurn = null; // Turn over
    } else {
        // For a jump move, only count the first jump
        if (pieceScoredThisTurn !== gamePiece) {
            score++;
            pieceScoredThisTurn = gamePiece;
        }
    }

    updateScoreDisplay();
}

function updateScoreDisplay() {
    document.getElementById('score-value').innerHTML = score;
}

function drawBoard() {
    var boardPiece = new THREE.BoxGeometry(SIZE_TILE, SIZE_TILE, SIZE_TILE);

    var tileBlack = 0x000000;
    var tileWhite = 0xFFFFFF;
    var tileColour = tileBlack;

    for (var row = 0; row < BOARD_WIDTH; row++) {
        for (var column = 0; column < BOARD_HEIGHT; column++) {

            // Alternate tile colour
            tileColour = (tileColour === tileBlack) ? tileWhite : tileBlack;

            var tile = new THREE.Mesh(boardPiece, new THREE.MeshLambertMaterial({color: tileColour}));
            tile.position.x = row * SIZE_TILE;
            tile.position.y = 0;
            tile.position.z = column * SIZE_TILE;
            tile.scale.x = 1;
            tile.scale.y = 1;
            tile.scale.z = 1;
            tile.castShadow = false;
            tile.receiveShadow = true;
            tile.type = TYPE_BOARD_PIECE;
            tile.row = row;
            tile.column = column;
            scene.add(tile);
        }
    }
}

function drawGamePieces() {
    const SIZE_PIECE = 10;
    var gamePiece = new THREE.CylinderBufferGeometry(5, 5, SIZE_PIECE, 8);

    for (var height = 0; height < 3; height++) {
        for (var width = 0; width < 3; width++) {

            // The cylindrical game piece
            var cylinder = new THREE.Mesh(gamePiece, new THREE.MeshBasicMaterial({color: colorGamePiece}));
            cylinder.position.x = width * SIZE_TILE;
            cylinder.position.y = SIZE_TILE;
            cylinder.position.z = height * SIZE_TILE;
            cylinder.castShadow = true;
            cylinder.receiveShadow = true;
            cylinder.type = TYPE_GAME_PIECE;
            cylinder.row = width;
            cylinder.column = height;
            scene.add(cylinder);

            // A wireframe on top of it to make it easier to see when they are bunched together
            var geo = new THREE.EdgesGeometry(cylinder.geometry);
            var mat = new THREE.LineBasicMaterial({color: 0xffffff, linewidth: 2});
            var wireframe = new THREE.LineSegments(geo, mat);
            cylinder.add(wireframe);
        }
    }
}

function setUpCamera() {
    camera = new THREE.PerspectiveCamera(45, container.clientWidth / gameWindowHeight, 1, 1000);
    camera.position.z = (BOARD_WIDTH * SIZE_TILE) / 2;
    camera.position.x = -200; // Halfway across board
    camera.position.y = 0;
    camera.lookAt(((BOARD_WIDTH * SIZE_TILE) / 2), 0, ((BOARD_HEIGHT * SIZE_TILE) / 2)); // Middle of the board
}

function setUpCameraControls() {
    controls = new THREE.OrbitControls(camera, container);
    controls.rotateSpeed = 0.5;
    controls.enableZoom = true;
    controls.zoomSpeed = 1;
    controls.enableDamping = true;
    controls.minPolarAngle = Math.PI / 3;
    controls.maxPolarAngle = Math.PI / 3;
    controls.target.set(((BOARD_WIDTH * SIZE_TILE) / 2), 0, ((BOARD_HEIGHT * SIZE_TILE) / 2)); // Middle of the board
}

function setUpSceneAndLighting() {
    scene = new THREE.Scene();
    scene.add(new THREE.AmbientLight(0x505050));

    var light = new THREE.SpotLight(0xffffff, 1.5);
    light.position.set(-100, 500, (BOARD_WIDTH * SIZE_TILE) / 2);
    light.castShadow = true;
    light.shadow = new THREE.LightShadow(new THREE.PerspectiveCamera(50, 1, 200, 10000));
    light.shadow.bias = -0.00022;
    light.shadow.mapSize.width = 2048;
    light.shadow.mapSize.height = 2048;
    scene.add(light);
}

function setUpRenderer() {
    if (renderer === null || renderer === undefined) {
        renderer = Detector.webgl ? new THREE.WebGLRenderer({antialias: true}) : new THREE.CanvasRenderer();
        renderer.setClearColor(0xf0f0f0);
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setSize(container.clientWidth, gameWindowHeight);
        renderer.sortObjects = false;
        renderer.shadowMap.enabled = true;
        renderer.shadowMap.type = THREE.PCFShadowMap;
        container.appendChild(renderer.domElement);
    }
}

function getHighScores() {
    $.ajax({
        url: 'game/GetScores.php',
        dataType: 'json',
        success: updateHighScoreTable
    });
}

function updateHighScoreTable(scoreData) {
    // Clear table
    $("#high-scores").empty();

    // Add header
    var header =
        `<tr>
        <th class="high-scores-country"></th>
        <th class="high-scores-name">Name</th>
        <th class="high-scores-score">Score</th>
        <th class="high-scores-date">Date</th>
        </tr>`;
    $("#high-scores").append(header);

    // Add each score
    $.each(scoreData, function (index, highScore) {
        $("#high-scores").append(createRowFromHighScoreData(highScore));
    })
}

function createRowFromHighScoreData(highScore) {
    var row =
        `<tr>
        <td class="high-scores-country">{flagString}</td>
        <td class="high-scores-name">{name}</td>
        <td class="high-scores-score">{score}</td>
        <td class="high-scores-date">{date}</td>
        </tr>`;

    var flagString = '<img src="http://www.geognos.com/api/en/countries/flag/{country}.png" class="game-flag">';

    if (highScore.Country != null) {
        row = row.replace("{flagString}", flagString);
        row = row.replace("{country}", highScore.Country);
    } else {
        row = row.replace("{flagString}", "");
    }

    row = row.replace("{name}", highScore.Name);
    row = row.replace("{score}", highScore.Score);
    row = row.replace("{date}", highScore.DateCreated);

    return row;
}