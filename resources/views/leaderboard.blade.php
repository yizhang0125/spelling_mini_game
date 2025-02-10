<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spelling Champions - Leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #6366F1;     /* Indigo */
            --secondary: #EC4899;    /* Pink */
            --success: #8B5CF6;     /* Purple */
            --warning: #F59E0B;     /* Amber */
            --danger: #EF4444;      /* Red */
            --light-bg: #F8FAFC;    /* Light Background */
            --white: #FFFFFF;
            --gold: #F59E0B;        /* Amber Gold */
            --silver: #94A3B8;      /* Cool Silver */
            --bronze: #D97706;      /* Bronze */
        }

        body {
            font-family: 'Nunito', sans-serif;
            color: #2D3748;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            background: #ffffff;
        }

        .bg-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.8;
            background: 
                linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%),
                repeating-linear-gradient(45deg, 
                    rgba(99, 102, 241, 0.05) 0px, 
                    rgba(99, 102, 241, 0.05) 2px, 
                    transparent 2px, 
                    transparent 10px
                );
        }

        .bg-pattern::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, rgba(99, 102, 241, 0.15) 0%, transparent 20%),
                radial-gradient(circle at 80% 80%, rgba(236, 72, 153, 0.15) 0%, transparent 20%),
                radial-gradient(circle at 50% 50%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366F1' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: patternFloat 30s linear infinite;
        }

        .bg-pattern::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(6px 6px at 25% 25%, rgba(99, 102, 241, 0.2) 0%, transparent 50%),
                radial-gradient(4px 4px at 75% 75%, rgba(236, 72, 153, 0.2) 0%, transparent 50%),
                radial-gradient(8px 8px at 50% 50%, rgba(139, 92, 246, 0.2) 0%, transparent 50%);
            animation: sparkle 10s ease-in-out infinite;
        }

        @keyframes patternFloat {
            0% {
                background-position: 0% 0%;
            }
            100% {
                background-position: 100% 100%;
            }
        }

        @keyframes sparkle {
            0%, 100% {
                opacity: 0.5;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.1);
            }
        }

        .leaderboard-container {
            position: relative;
            z-index: 1;
            max-width: 1000px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }

        .leaderboard-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .leaderboard-title {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            text-shadow: 2px 2px 4px rgba(99, 102, 241, 0.2);
        }

        .leaderboard-subtitle {
            color: #6B7280;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .leaderboard-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(99, 102, 241, 0.1);
            box-shadow: 
                0 10px 30px rgba(99, 102, 241, 0.1),
                0 4px 8px rgba(99, 102, 241, 0.05),
                inset 0 0 0 1px rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            padding: 2rem;
        }

        .player-row {
            display: grid;
            grid-template-columns: 80px 2fr 1fr 1fr;
            gap: 1.5rem;
            align-items: center;
            padding: 1.2rem;
            margin: 0.8rem 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(99, 102, 241, 0.1);
            box-shadow: 
                0 2px 4px rgba(99, 102, 241, 0.05),
                inset 0 0 0 1px rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .player-row:hover {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(99, 102, 241, 0.2);
            box-shadow: 
                0 4px 12px rgba(99, 102, 241, 0.1),
                inset 0 0 0 1px rgba(255, 255, 255, 0.8);
            transform: translateY(-2px);
        }

        .rank {
            font-size: 1.8rem;
            font-weight: 800;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto;
            position: relative;
        }

        .rank-1 { 
            background: linear-gradient(45deg, #F59E0B, #FCD34D);
            color: #92400E;
        }
        .rank-2 { 
            background: linear-gradient(45deg, #94A3B8, #CBD5E1);
            color: #1F2937;
        }
        .rank-3 { 
            background: linear-gradient(45deg, #D97706, #FBBF24);
            color: #92400E;
        }

        .rank i {
            font-size: 2rem;
        }

        .player-name {
            font-weight: 700;
            color: #1F2937;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .player-name i {
            color: var(--primary);
        }

        .level-badge {
            padding: 0.6rem 1.2rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: fit-content;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: none;
            animation: pulse 2s infinite;
        }

        .level-easy { 
            background: linear-gradient(45deg, #6366F1, #818CF8);
            color: white;
        }
        .level-medium { 
            background: linear-gradient(45deg, #EC4899, #F472B6);
            color: white;
        }
        .level-hard { 
            background: linear-gradient(45deg, #8B5CF6, #A78BFA);
            color: white;
        }

        .player-score {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary);
            text-align: right;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #6366F1, #818CF8);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 2rem;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .back-button:hover {
            background: linear-gradient(135deg, #818CF8, #6366F1);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        @media (max-width: 768px) {
            .leaderboard-container {
                padding: 2rem 1rem;
            }

            .player-row {
                grid-template-columns: 60px 1fr 1fr;
                gap: 1rem;
                padding: 1rem;
            }

            .player-level {
                display: none;
            }

            .rank {
                width: 45px;
                height: 45px;
                font-size: 1.4rem;
            }

            .player-name {
                font-size: 1rem;
            }

            .player-score {
                font-size: 1.1rem;
            }
        }

        /* Add these new styles for enhanced visual effects */
        .rank::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Update trophy colors */
        .bi-trophy-fill.text-warning {
            color: #F59E0B !important;
        }

        .bi-star-fill.text-warning {
            color: #F59E0B !important;
        }
    </style>
</head>
<body>
    <div class="bg-pattern"></div>
    <div class="leaderboard-container">
        <div class="leaderboard-header animate__animated animate__fadeInDown">
            <h1 class="leaderboard-title">
                <i class="bi bi-trophy-fill text-warning"></i>
                Spelling Champions
                <i class="bi bi-trophy-fill text-warning"></i>
            </h1>
            <p class="leaderboard-subtitle">
                <i class="bi bi-stars"></i> Top Players Worldwide <i class="bi bi-stars"></i>
            </p>
        </div>

        <div class="leaderboard-card animate__animated animate__fadeInUp">
            @foreach ($scores as $index => $score)
                <div class="player-row animate__animated animate__fadeInUp animate__delay-{{ $index }}s">
                    <div class="rank-container">
                        @if ($index == 0)
                            <div class="rank rank-1"><i class="bi bi-trophy-fill"></i></div>
                        @elseif ($index == 1)
                            <div class="rank rank-2"><i class="bi bi-award-fill"></i></div>
                        @elseif ($index == 2)
                            <div class="rank rank-3"><i class="bi bi-award-fill"></i></div>
                        @else
                            <div class="rank">#{{ $index + 1 }}</div>
                        @endif
                    </div>
                    <div class="player-name">
                        <i class="bi bi-person-circle"></i>
                        {{ $score->player->nickname }}
                    </div>
                    <div class="player-level">
                        <span class="level-badge level-{{ $score->max_difficulty }}">
                            <i class="bi bi-lightning-charge-fill"></i>
                            {{ ucfirst($score->max_difficulty) }}
                        </span>
                    </div>
                    <div class="player-score">
                        <i class="bi bi-star-fill text-warning"></i>
                        {{ number_format($score->score) }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('game') }}" class="back-button animate__animated animate__fadeInUp animate__delay-1s">
                <i class="bi bi-controller"></i>
                Back to Game
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
