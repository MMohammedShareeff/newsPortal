<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\config\DatabaseConnection;

$pdo = DatabaseConnection::getConnection();

$mostCommentedStmt = $pdo->prepare("
  SELECT n.title, n.id
  FROM news n
  LEFT JOIN comments c ON c.news_id = n.id
  GROUP BY n.id
  ORDER BY COUNT(c.id) DESC
  LIMIT 5
");
$mostCommentedStmt->execute();
$mostCommented = $mostCommentedStmt->fetchAll(PDO::FETCH_ASSOC);

function limitWords($text, $limit = 20) {
    $words = explode(' ', $text);
    if (count($words) <= $limit) {
        return $text;
    }
    return implode(' ', array_slice($words, 0, $limit)) . '…';
}

foreach ($mostCommented as $i => $item) {
    echo '<li class="list-group-item">';
    echo '<a href="details.php?news_id=' . urlencode($item['id']) . '" class="text-decoration-none; color: inherit;">';
    echo htmlspecialchars(limitWords($item['title'], 20));
    echo '</a></li>';
    if ($i < count($mostCommented) - 1) {
        echo '<hr />';
    }
}
