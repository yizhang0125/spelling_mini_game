<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaderboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #f8fafc, #e3f2fd); /* Subtle gradient */
            font-family: 'Arial', sans-serif;
        }

        h1 {
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            color: #4CAF50; /* Highlighted green for headings */
        }

        .rank-icon {
            font-size: 1.5rem;
        }

        .rank-1 {
            color: gold;
        }

        .rank-2 {
            color: silver;
        }

        .rank-3 {
            color: #cd7f32; /* Bronze */
        }

        .table thead th {
            background-color: #4CAF50;
            color: #fff;
        }

        .btn-success:hover {
            opacity: 0.9;
            transform: scale(1.02);
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center text-success mb-4">Leaderboard</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">Rank</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scores as $index => $score)
                        <tr>
                            <th scope="row">
                                @if ($index == 0)
                                    <span class="rank-icon rank-1">🥇</span>
                                @elseif ($index == 1)
                                    <span class="rank-icon rank-2">🥈</span>
                                @elseif ($index == 2)
                                    <span class="rank-icon rank-3">🥉</span>
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </th>
                            <td>{{ $score->player->nickname }}</td>
                            <td>{{ $score->score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('game') }}" class="btn btn-success btn-lg">Back to Game</a>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
