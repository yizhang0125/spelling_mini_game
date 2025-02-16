<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Spelling Master Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #4F46E5;
            --secondary: #EC4899;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background: linear-gradient(135deg, #f6f8ff 0%, #f0f4ff 100%);
            min-height: 100vh;
        }

        .game-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .game-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(79, 70, 229, 0.1);
            transition: all 0.3s ease;
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(79, 70, 229, 0.15);
        }

        .game-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            text-align: center;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .game-input {
            background: #f8fafc;
            border: 2px solid rgba(79, 70, 229, 0.2);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 1.5rem;
        }

        .game-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            transform: translateY(-2px);
        }

        #word {
            font-size: clamp(2rem, 10vw, 5rem);
            font-weight: 800;
            text-align: center;
            padding: 3rem 4rem;
            margin: 2rem auto;
            background: rgba(79, 70, 229, 0.05);
            border-radius: 16px;
            letter-spacing: 0.4em;
            color: var(--primary);
            width: 100%;
            max-width: none;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.1);
            border: 2px solid rgba(79, 70, 229, 0.1);
            animation: wordPulse 2s infinite;
            overflow: hidden;
            word-break: break-all;
        }

        #word::-webkit-scrollbar,
        #word::-webkit-scrollbar-track,
        #word::-webkit-scrollbar-thumb {
            display: none;
        }

        .game-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .stat-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(79, 70, 229, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6B7280;
        }

        .game-button {
            background: linear-gradient(45deg, var(--primary), #818CF8);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .game-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(79, 70, 229, 0.4);
        }

        @keyframes wordPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        @media (max-width: 768px) {
            .game-container { 
                padding: 1rem;
                max-width: 100%;
            }
            .game-card { padding: 1.5rem; }
            #word { 
                font-size: 3rem;
                padding: 2rem;
                letter-spacing: 0.4em;
                min-height: 120px;
            }
            .game-stats {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        .feedback-message {
            text-align: center;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 600;
            margin: 1.5rem 0;
            animation: fadeInDown 0.3s ease-out;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .feedback-success {
            background: linear-gradient(45deg, #10B981, #34D399);
            color: white;
            border: none;
        }

        .feedback-error {
            background: linear-gradient(45deg, #EF4444, #F87171);
            color: white;
            border: none;
        }

        .feedback-warning {
            background: linear-gradient(45deg, #F59E0B, #FBBF24);
            color: white;
            border: none;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="game-container">
        <div id="nicknameFormContainer">
            <div class="game-card">
                <h1 class="game-title">
                    <i class="bi bi-keyboard-fill"></i>
                    Spelling Master
                </h1>
                <form id="nicknameForm" class="text-center">
                    @csrf
                    <div class="mb-4">
                        <input type="text" id="nickname" name="nickname" 
                               class="game-input" required 
                               placeholder="Enter your name to start...">
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="game-button">
                            <i class="bi bi-play-fill"></i> Start Game
                        </button>
                        <a href="{{ route('leaderboard') }}" class="game-button">
                            <i class="bi bi-trophy-fill"></i> Leaderboard
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div id="gameArea" style="display: none;">
            <div class="game-card">
                <div id="word"></div>
                
                <div id="message" class="feedback-message mb-3" style="display: none;"></div>

                <div class="input-wrapper">
                    <input type="text" id="answer" class="game-input" 
                           placeholder="Type your answer here..." autocomplete="off">
                </div>

                <div class="text-center">
                    <button id="submitAnswer" class="game-button">
                        <i class="bi bi-check2-circle"></i> Submit
                    </button>
                </div>

                <div class="game-stats">
                    <div class="stat-card">
                        <div class="stat-value" id="timeLeft">60</div>
                        <div class="stat-label">Seconds Left</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="score">0</div>
                        <div class="stat-label">Score</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Keep your existing JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const wordsByDifficulty = {
            easy: [
                // 3-5 letter fruits
                "fig", "pear", "plum", "lime", "kiwi",
                "date", "apple", "grape", "mango",
                "peach", "berry", "melon"
            ],
            medium: [
                // 6-8 letter fruits
                "banana", "orange", "papaya", "guava",
                "apricot", "coconut", "lychee", "dragon",
                "durian", "passion", "avocado", "plantain"
            ],
            hard: [
                // 9+ letter fruits
                "pineapple", "strawberry", "blackberry",
                "grapefruit", "pomegranate", "blueberry",
                "cranberry", "gooseberry", "dragonfruit",
                "passionfruit", "boysenberry", "loganberry"
            ]
        };

        let currentDifficulty = 'easy';
        let consecutiveCorrect = 0;
        let words = [...wordsByDifficulty.easy]; // Start with easy words
        let userId, score = 0, timer = 60, currentWordIndex = 0, originalWord = '';
        let gameStarted = false;

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

            return masked.join(' ');
        }

        document.getElementById('nicknameForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const nickname = document.getElementById('nickname').value;

            try {
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
            } catch (error) {
                console.error('Error:', error);
                alert('There was an error starting the game. Please try again.');
            }
        });

        function startGame() {
            if (gameStarted) return;
            gameStarted = true;
            
            updateDifficultyBadge(); // Add initial difficulty badge
            
            const interval = setInterval(() => {
                timer--;
                document.getElementById('timeLeft').textContent = timer;

                if (timer <= 0) {
                    clearInterval(interval);
                    endGame();
                }
            }, 1000);

            showNextWord();
            setupEventListeners();
            document.getElementById('answer').focus();
        }

        function setupEventListeners() {
            const submitButton = document.getElementById('submitAnswer');
            submitButton.onclick = checkAnswer;

            const answerInput = document.getElementById('answer');
            answerInput.onkeypress = function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    checkAnswer();
                }
            };
        }

        function showNextWord() {
            if (currentWordIndex < words.length) {
                originalWord = words[currentWordIndex];
                const maskedWord = maskWord(originalWord);
                document.getElementById('word').textContent = maskedWord;
                document.getElementById('answer').value = '';
                document.getElementById('answer').focus();
            } else {
                endGame();
            }
        }

        function showMessage(message, type) {
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = message;
            messageDiv.className = `feedback-message feedback-${type}`;
            messageDiv.style.display = 'block';
        }

        function hideMessage() {
            const messageDiv = document.getElementById('message');
            messageDiv.style.display = 'none';
        }

        function checkAnswer() {
            const userAnswer = document.getElementById('answer').value.trim().toLowerCase();
            
            // Check if answer is empty
            if (!userAnswer) {
                showMessage('Please type your answer first!', 'warning');
                document.getElementById('answer').focus();
                return; // Don't proceed if empty
            }
            
            if (userAnswer === originalWord.toLowerCase()) {
                score += getDifficultyScore();
                consecutiveCorrect++;
                document.getElementById('score').textContent = score;
                showSuccess();
                
                // Check for difficulty progression
                if (currentDifficulty === 'easy' && consecutiveCorrect >= 5) {
                    advanceDifficulty('medium');
                } else if (currentDifficulty === 'medium' && consecutiveCorrect >= 8) {
                    advanceDifficulty('hard');
                }
            } else {
                consecutiveCorrect = 0;
                showError();
            }

            currentWordIndex++;
            setTimeout(() => {
                hideMessage();
                showNextWord();
            }, 1500);
        }

        function getDifficultyScore() {
            switch(currentDifficulty) {
                case 'hard': return 30;
                case 'medium': return 20;
                default: return 10;
            }
        }

        function advanceDifficulty(newDifficulty) {
            currentDifficulty = newDifficulty;
            words = [...wordsByDifficulty[newDifficulty]];
            shuffleWords();
            currentWordIndex = 0;
            
            // Show level up message
            showAchievement(`Level Up! ${newDifficulty.toUpperCase()} difficulty unlocked! 🎉`);
            
            // Update difficulty badge
            updateDifficultyBadge();
        }

        function showSuccess() {
            showMessage('✨ Excellent! You spelled it correctly! ✨', 'success');
            const answer = document.getElementById('answer');
            answer.value = '';
            answer.focus();
        }

        function showError() {
            showMessage(`❌ The correct spelling was: "${originalWord}" ❌`, 'error');
            const answer = document.getElementById('answer');
            answer.value = '';
            answer.focus();
        }

        function showAchievement(message) {
            const achievement = document.createElement('div');
            achievement.className = 'achievement animate__animated animate__fadeInDown';
            achievement.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background: white;
                padding: 1rem 2rem;
                border-radius: 9999px;
                box-shadow: 0 4px 20px rgba(79, 70, 229, 0.2);
                z-index: 1000;
                font-weight: bold;
                color: var(--primary);
            `;
            achievement.textContent = message;
            document.body.appendChild(achievement);
            
            setTimeout(() => {
                achievement.classList.add('animate__fadeOutUp');
                setTimeout(() => achievement.remove(), 1000);
            }, 3000);
        }

        function updateDifficultyBadge() {
            const badge = document.createElement('div');
            badge.className = `difficulty-badge difficulty-${currentDifficulty}`;
            badge.style.cssText = `
                position: absolute;
                top: 1rem;
                right: 1rem;
                padding: 0.5rem 1rem;
                border-radius: 9999px;
                font-size: 0.875rem;
                font-weight: bold;
                text-transform: uppercase;
                animation: fadeIn 0.5s ease-out;
            `;
            
            const colors = {
                easy: '#10B981',
                medium: '#F59E0B',
                hard: '#EF4444'
            };
            
            badge.style.background = colors[currentDifficulty];
            badge.style.color = 'white';
            badge.innerHTML = `<i class="bi bi-stars"></i> ${currentDifficulty.toUpperCase()}`;
            
            const gameCard = document.querySelector('.game-card');
            const oldBadge = gameCard.querySelector('.difficulty-badge');
            if (oldBadge) oldBadge.remove();
            gameCard.appendChild(badge);
        }

        async function endGame() {
            if (!gameStarted) return;
            gameStarted = false;

            try {
                await fetch('/submit_score', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ player_id: userId, score })
                });

                alert('Game over! Your score: ' + score);
                window.location.href = '/leaderboard';
            } catch (error) {
                console.error('Error:', error);
                alert('There was an error saving your score. Please try again.');
            }
        }

        document.getElementById('nickname').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                document.getElementById('nicknameForm').dispatchEvent(new Event('submit'));
            }
        });

        document.getElementById('nickname').focus();
    </script>
</body>
</html>
        