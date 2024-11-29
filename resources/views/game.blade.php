<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Spelling Mini Game</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #f8fafc, #e3f2fd); /* Subtle gradient */
            font-family: 'Arial', sans-serif;
        }

        h1, h2 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            color: #4CAF50; /* Highlighted green for headings */
        }

        #nicknameForm {
            max-width: 400px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        #gameArea #word {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
            letter-spacing: 5px;
            background: rgba(255, 255, 0, 0.2);
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-block;
        }

        #timeLeft, #score {
            font-size: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #ced4da;
        }

        .shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Add hover effect for buttons */
        .btn:hover {
            opacity: 0.9;
            transform: scale(1.02);
            transition: all 0.2s ease;
        }

        /* Add some animation to the word display */
        @keyframes wordFadeIn {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }

        #word {
            animation: wordFadeIn 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <!-- Nickname Form -->
        <div id="nicknameFormContainer" class="text-center">
            <form id="nicknameForm" method="POST" class="d-inline-block bg-white p-4 shadow rounded">
                @csrf
                <h1 class="mb-4">Spelling Mini Game</h1>
                <div class="mb-3">
                    <label for="nickname" class="form-label">Enter Your Name:</label>
                    <input type="text" id="nickname" name="nickname" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Start Game</button>
                    <a href="{{ route('leaderboard') }}" class="btn btn-primary">View Leaderboard</a>
                </div>
            </form>
        </div>

        <!-- Game Area -->
        <div id="gameArea" style="display: none;" class="text-center">
            <h2 class="mb-3 text-success">Spelling Mini Game</h2>
            <p id="word" class="display-4 mb-4"></p>
            <div class="mb-3">
                <input type="text" id="answer" class="form-control w-50 mx-auto" placeholder="Type your answer">
            </div>
            <button id="submitAnswer" class="btn btn-warning">Submit</button>
            <div class="mt-4">
                <p class="h5">Time Left: <span id="timeLeft" class="text-danger fw-bold">60</span> seconds</p>
                <p class="h5">Score: <span id="score" class="text-primary fw-bold">0</span></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const words = ["apple", "banana", "cherry", "grape", "orange", "lemon", "strawberry", "peach", "melon", "kiwi"];
        let userId, score = 0, timer = 60, currentWordIndex = 0, originalWord = '';

        function shuffleWords() {
            for (let i = words.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [words[i], words[j]] = [words[j], words[i]];
            }
        }

        function maskWord(word) {
            const letters = word.split('');
            let masked = letters.map(() => '_');

            const indicesToReveal = new Set();
            while (indicesToReveal.size < Math.min(3, letters.length)) {
                indicesToReveal.add(Math.floor(Math.random() * letters.length));
            }

            indicesToReveal.forEach((index) => {
                masked[index] = letters[index];
            });

            return masked.join('');
        }

        document.getElementById('nicknameForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const nickname = document.getElementById('nickname').value;

            const response = await fetch('/start-game', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ nickname })
            });

            const data = await response.json();
            userId = data.player.id;

            document.getElementById('nicknameFormContainer').style.display = 'none';
            document.getElementById('gameArea').style.display = 'block';

            shuffleWords();
            startGame();
        });

        async function startGame() {
            const interval = setInterval(() => {
                timer--;
                document.getElementById('timeLeft').textContent = timer;

                if (timer <= 0) {
                    clearInterval(interval);
                    endGame();
                }
            }, 1000);

            showNextWord();
            document.getElementById('submitAnswer').addEventListener('click', checkAnswer);
        }

        function showNextWord() {
            if (currentWordIndex < words.length) {
                originalWord = words[currentWordIndex];
                const maskedWord = maskWord(originalWord);
                document.getElementById('word').textContent = maskedWord;
                document.getElementById('answer').value = '';
            } else {
                endGame();
            }
        }

        function checkAnswer() {
            const userAnswer = document.getElementById('answer').value.trim().toLowerCase();

            if (userAnswer === originalWord.toLowerCase()) {
                score++;
                document.getElementById('score').textContent = score;
            }

            currentWordIndex++;
            showNextWord();
        }

        async function endGame() {
            await fetch('/submit_score', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ player_id: userId, score })
            });

            alert('Game over! Your score: ' + score);
            location.reload();
        }
    </script>
</body>
</html>
        