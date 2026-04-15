<?php
session_start();

if (!isset($_SESSION['result'])) {
  $_SESSION['result'] = '';
}
if (!isset($_SESSION['total_clicks'])) {
  $_SESSION['total_clicks'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
  $action = $_GET['action'];

  if ($action === 'reset') {
    $_SESSION['result'] = '';
  } elseif (is_numeric($action) && strlen($action) === 1 && $action >= 0 && $action <= 9) {
    $_SESSION['result'] .= $action;
    $_SESSION['total_clicks']++;
  }

  header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
  exit();
}

$current_result = $_SESSION['result'];
$total_clicks = $_SESSION['total_clicks'];
?>
<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Агаев Арслан 241-353 ЛР-3</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header><img src="./logo.png" alt="" width="90"><span>Агаев Арслан 241-353 ЛР-2 Вариант 1</span></header>
  <main>
    <div class="calculator-container">
      <!-- Result display window -->
      <div class="result-window <?php echo empty($current_result) ? 'empty' : ''; ?>">
        <?php echo empty($current_result) ? 'Результат' : htmlspecialchars($current_result); ?>
      </div>

      <!-- Buttons grid -->
      <div class="buttons-grid">
        <?php
        // Generate digit buttons 0-9
        for ($i = 0; $i <= 9; $i++): ?>
          <a href="?action=<?php echo $i; ?>" class="digit-btn"><?php echo $i; ?></a>
        <?php endfor; ?>

        <!-- Reset button -->
        <a href="?action=reset" class="reset-btn">СБРОС</a>
      </div>
    </div>
  </main>
  <footer>
    <span>© copyright 2026</span>
    <span>Всего нажатий: <?php echo $total_clicks; ?></span>
  </footer>
</body>

</html>