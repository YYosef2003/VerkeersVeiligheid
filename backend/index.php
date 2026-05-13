<?php
// (optioneel) hier kun je later login/session toevoegen
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crossy Road</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="container">
    
    <!-- GAME -->
    <section class="game-section">
      <h1>🐔 Crossy Road</h1>
      <p class="subtitle">Steek over, pak coins en haal de hoogste score.</p>

      <div class="top-controls">
        <input type="text" id="playerName" placeholder="Vul je naam in" maxlength="50">
        <button id="startBtn">Start spel</button>
        <button id="restartBtn">Opnieuw</button>
      </div>

      <div class="stats">
        <div class="stat-box">Score: <span id="score">0</span></div>
        <div class="stat-box">Status: <span id="status">Wacht op start</span></div>
      </div>

      <canvas id="gameCanvas" width="400" height="600"></canvas>

      <p id="message" class="message"></p>
    </section>

    <!-- LEADERBOARD -->
    <aside class="leaderboard-section">
      <h2>🏆 Leaderboard</h2>
      <button id="loadScoresBtn">Ververs highscores</button>

      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Naam</th>
              <th>Score</th>
              <th>Datum</th>
            </tr>
          </thead>
          <tbody id="highscoreTableBody">
            <?php
            // direct scores tonen bij laden (optioneel)
            try {
                require "db.php";

                $stmt = $conn->query("
                  SELECT h1.player_name, h1.score, h1.created_at
                  FROM highscores h1
                  INNER JOIN (
                      SELECT player_name, MAX(score) AS max_score
                      FROM highscores
                      GROUP BY player_name
                  ) h2
                  ON h1.player_name = h2.player_name
                  AND h1.score = h2.max_score
                  ORDER BY h1.score DESC
                  LIMIT 10
                ");

                $scores = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($scores) {
                    $i = 1;
                    foreach ($scores as $row) {
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['player_name']) . "</td>";
                        echo "<td>" . $row['score'] . "</td>";
                        echo "<td>" . date("d-m-Y", strtotime($row['created_at'])) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nog geen scores</td></tr>";
                }

            } catch (Exception $e) {
                echo "<tr><td colspan='4'>Database fout</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </aside>

  </main>

  <script src="script.js"></script>
</body>
</html>