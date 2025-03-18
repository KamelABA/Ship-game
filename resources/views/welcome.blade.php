@extends('layout.layout')

@section('content')




<div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center">
    <i class="fas fa-ship fa-5x text-white mb-3"></i>
    <h1 class="display-4">🎮 Welcome to the Game</h1>
    <p class="lead">Get ready for an exciting experience!</p>
    <div class="mt-3">
        <a href="/play" class="btn btn-success btn-lg">Play Now</a>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#leaderboardModal">
            🏆 Leaderboard
        </button>
    </div>
</div>


<div class="modal fade" id="leaderboardModal" tabindex="-1" aria-labelledby="leaderboardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leaderboardModalLabel">🏆 Leaderboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="filterPeriod" class="form-label">Filter by Period:</label>
                    <select id="filterPeriod" class="form-select">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="global">Global</option>
                    </select>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Player</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody id="leaderboardBody">
                        @foreach ($leaderboard as $index => $player)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->score }}
                                <p style="font-size: 12px;">
                                    Wins:
                                    {{ $player->wins ?? 0 }}
                                    Losses:
                                    {{ $player->loses ?? 0 }}
                                </p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('filterPeriod').addEventListener('change', function() {
        let period = this.value;

        fetch(`/leaderboard/filter?period=${period}`)
            .then(response => response.json())
            .then(data => {
                let tbody = document.getElementById('leaderboardBody');
                tbody.innerHTML = ''; // تفريغ الجدول قبل التحديث

                data.forEach((player, index) => {
                    let row = `<tr>
                            <td>${index + 1}</td>
                            <td>${player.name}</td>
                            <td>${player.score}
                                <p style="font-size: 12px;">
                                    Wins: ${player.wins ?? 0} Losses: ${player.loses ?? 0}
                                </p>
                            </td>
                        </tr>`;
                    tbody.innerHTML += row;
                });
            })
            .catch(error => console.error('Error fetching leaderboard:', error));
    });
</script>



@endsection