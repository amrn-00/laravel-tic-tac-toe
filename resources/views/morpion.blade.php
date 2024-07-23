<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu de Morpion</title>
    <style>
        body {
            background-color: black;
            color: white;
        }
        .board {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-template-rows: repeat(3, 100px);
            gap: 5px;
            margin: 50px auto;
            max-width: 310px;
        }
        .cell {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            cursor: pointer;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            color: black;
        }
        .scoreboard {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="scoreboard">
        <p>Score</p>
        <p>Joueur X: <span id="scoreX">0</span> | Joueur O: <span id="scoreO">0</span></p>
    </div>
    <div class="board">
        <div class="cell" onclick="makeMove(0, 0)"></div>
        <div class="cell" onclick="makeMove(0, 1)"></div>
        <div class="cell" onclick="makeMove(0, 2)"></div>
        <div class="cell" onclick="makeMove(1, 0)"></div>
        <div class="cell" onclick="makeMove(1, 1)"></div>
        <div class="cell" onclick="makeMove(1, 2)"></div>
        <div class="cell" onclick="makeMove(2, 0)"></div>
        <div class="cell" onclick="makeMove(2, 1)"></div>
        <div class="cell" onclick="makeMove(2, 2)"></div>
    </div>
    <script>
        let board = [
            ['', '', ''],
            ['', '', ''],
            ['', '', '']
        ];
        let currentPlayer = 'X';
        let scoreX = 0;
        let scoreO = 0;

        function makeMove(row, col) {
            if (board[row][col] === '') {
                board[row][col] = currentPlayer;
                document.querySelectorAll('.cell')[row * 3 + col].innerText = currentPlayer;
                if (checkWinner()) {
                    if (currentPlayer === 'X') {
                        scoreX++;
                        document.getElementById('scoreX').innerText = scoreX;
                    } else {
                        scoreO++;
                        document.getElementById('scoreO').innerText = scoreO;
                    }
                    alert(currentPlayer + ' a gagné!');
                    resetBoard();
                } else if (board.flat().every(cell => cell !== '')) {
                    alert('Match nul!');
                    resetBoard();
                } else {
                    currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
                }
            }
        }

        function checkWinner() {
            const lines = [
                [board[0][0], board[0][1], board[0][2]],
                [board[1][0], board[1][1], board[1][2]],
                [board[2][0], board[2][1], board[2][2]],
                [board[0][0], board[1][0], board[2][0]],
                [board[0][1], board[1][1], board[2][1]],
                [board[0][2], board[1][2], board[2][2]],
                [board[0][0], board[1][1], board[2][2]],
                [board[0][2], board[1][1], board[2][0]]
            ];

            for (let line of lines) {
                if (line[0] && line[0] === line[1] && line[0] === line[2]) {
                    return true;
                }
            }
            return false;
        }

        function resetBoard() {
            board = [
                ['', '', ''],
                ['', '', ''],
                ['', '', '']
            ];
            document.querySelectorAll('.cell').forEach(cell => cell.innerText = '');
            currentPlayer = 'X';
        }
    </script>
</body>
</html>
