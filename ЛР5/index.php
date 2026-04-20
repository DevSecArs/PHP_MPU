<?php

$type = 'table';

if (isset($_GET['type'])) {
  if ($_GET['type'] == 'table') {
    $type = "table";
  } elseif ($_GET['type'] == 'block') {
    $type = "block";
  }
}

?>
<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Агаев Арслан 241-353 ЛР-5 Вариант 1</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header>
    <div>
      <img src="./logo.png" alt="" width="90">
      <span>Агаев Арслан 241-353 ЛР-5 Вариант 1</span>
    </div>
    <div class="right">
      <h3>Тип вёрстки</h3>
      <a href="./index.php?type=table" <?php echo (isset($_GET['type']) && $type == "table") ? "class='active'" : ""; ?>>Табличная</a>
      <a href="./index.php?type=block" <?php echo (isset($_GET['type']) && $type == "block") ? "class='active'" : ""; ?>>Блочная</a>
    </div>
  </header>
  <main>
    <div class="menu">

    </div>

    <div class="multiplication_table">

    </div>
  </main>
  <footer>@copyright 2026</footer>
</body>

</html>