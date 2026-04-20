<?php
$type = 'table';
if (isset($_GET['type'])) {
  if ($_GET['type'] == 'table') {
    $type = "table";
  } elseif ($_GET['type'] == 'block') {
    $type = "block";
  }
}

$num = isset($_GET['num']) ? (int)$_GET['num'] : 0;
if ($num < 0 || $num > 9) $num = 0;

$menuTitle = $num == 0 ? 'Вся таблица умножения' : "Таблица умножения на {$num}";
date_default_timezone_set('Europe/Moscow');
$currentDateTime = date('d.m.Y H:i:s');
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
      <a href="./index.php?type=table<?php echo $num ? "&num={$num}" : ''; ?>" <?php echo (isset($_GET['type']) && $type == "table") ? "class='active'" : ""; ?>>Табличная</a>
      <a href="./index.php?type=block<?php echo $num ? "&num={$num}" : ''; ?>" <?php echo (isset($_GET['type']) && $type == "block") ? "class='active'" : ""; ?>>Блочная</a>
    </div>
  </header>
  <main>
    <div class="menu">
      <h3>Таблица умножения</h3>
      <a href="./index.php?type=<?php echo $type; ?>" <?php echo $num == 0 ? "class='active'" : ""; ?>>Всё</a>
      <?php for ($i = 2; $i <= 9; $i++): ?>
        <a href="./index.php?<?php echo (isset($_GET['type'])) ? 'type=' . $type . '&num=' . $i : 'num=' . $i; ?>" <?php echo ($num == $i) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
      <?php endfor; ?>
    </div>

    <div class=" multiplication_table">
      <h2><?php echo $menuTitle; ?></h2>
      <?php if ($type == 'table'): ?>
        <table class="mult-table">
          <?php if ($num == 0): ?>
            <?php for ($i = 1; $i <= 8; $i++): ?>
              <tr>
                <?php for ($j = 2; $j <= 9; $j++): ?>
                  <td>
                    <a href="./index.php?num=<?php echo $j; ?>"><?php echo $j; ?></a> ×
                    <a href="./index.php?num=<?php echo $i; ?>"><?php echo $i; ?></a> =
                    <a href="./index.php?num=<?php echo $i * $j; ?>"><?php echo $i * $j; ?></a>
                  </td>
                <?php endfor; ?>
              </tr>
            <?php endfor; ?>
          <?php else: ?>
            <?php for ($i = 1; $i <= 10; $i++): ?>
              <tr>
                <td>
                  <a href="./index.php?num=<?php echo $num; ?>"><?php echo $num; ?></a> ×
                  <a href="./index.php?num=<?php echo $i; ?>"><?php echo $i; ?></a> =
                  <a href="./index.php?num=<?php echo $num * $i; ?>"><?php echo $num * $i; ?></a>
                </td>
              </tr>
            <?php endfor; ?>
          <?php endif; ?>
        </table>
      <?php else: ?>
        <div class="block-table">
          <?php if ($num == 0): ?>
            <?php for ($i = 1; $i <= 8; $i++): ?>
              <div class="block-row">
                <?php for ($j = 2; $j <= 9; $j++): ?>
                  <div class="block-cell">
                    <a href="./index.php?num=<?php echo $j; ?>"><?php echo $j; ?></a> ×
                    <a href="./index.php?num=<?php echo $i; ?>"><?php echo $i; ?></a> =
                    <a href="./index.php?num=<?php echo $i * $j; ?>"><?php echo $i * $j; ?></a>
                  </div>
                <?php endfor; ?>
              </div>
            <?php endfor; ?>
          <?php else: ?>
            <?php for ($i = 1; $i <= 10; $i++): ?>
              <div class="block-row">
                <div class="block-cell large">
                  <a href="./index.php?num=<?php echo $num; ?>"><?php echo $num; ?></a> ×
                  <a href="./index.php?num=<?php echo $i; ?>"><?php echo $i; ?></a> =
                  <a href="./index.php?num=<?php echo $num * $i; ?>"><?php echo $num * $i; ?></a>
                </div>
              </div>
            <?php endfor; ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </main>
  <footer>
    <span>Тип вёрстки: <?php echo $type == 'table' ? 'Табличная' : 'Блочная'; ?></span>
    <span><?php echo $menuTitle; ?></span>
    <span><?php echo $currentDateTime; ?></span>
  </footer>
</body>

</html>