<?php
// ============================================
// 1. Инициализация числовых переменных
// ============================================
$startValue = 25;      // начальное значение аргумента x
$countValues = 15;    // количество вычисляемых значений функции
$step = 2;            // шаг изменения аргумента
$maxFunction = 100;   // максимальное значение функции (при превышении — останов)
$minFunction = -50;   // минимальное значение функции (при падении ниже — останов)

// ============================================
// 2. Инициализация строковой переменной с типом вёрстки
// Допустимые значения: 'A', 'B', 'C', 'D', 'E'
// ============================================
$layoutType = 'D';    // можно менять на A, B, C, D, E

// ============================================
// 3. Функция f(x) по заданному условию
// ============================================
function calculateFunction($x)
{
  if ($x <= 10) {
    return 10 * $x - 5;
  } elseif ($x < 20) {
    return ($x + 3) * pow($x, 2);
  } else {
    if (($x - 25) == 0) {
      return "error";
    }
    return (3 / ($x - 25)) + 2;
  }
}

// ============================================
// Вычисление значений с проверкой границ
// ============================================
$results = [];        // массив для хранения [x => y]
$currentX = $startValue;

for ($i = 0; $i < $countValues; $i++) {
  $y = calculateFunction($currentX);

  if ($y == "error") {
    $results[$currentX] = $y;
    $currentX += $step;
    continue;
  }

  // Проверка на превышение max или min
  if ($y > $maxFunction || $y < $minFunction) {
    break;  // останавливаем вычисления
  }

  $results[$currentX] = round($y, 3);
  $currentX += $step;
}

// ============================================
// 6. Статистика по значениям функции
// ============================================
$values = array_values($results);
$clean_values = array_diff($values, ['error']);
$sum = array_sum($clean_values);
$count = count($clean_values);
$average = $count > 0 ? $sum / $count : 0;
$maxValue = $count > 0 ? max($clean_values) : null;
$minValue = $count > 0 ? min($clean_values) : null;

// ============================================
// 5. Функция вывода в зависимости от типа вёрстки
// ============================================
function renderResults($results, $layoutType)
{
  $output = '';
  $index = 1;

  switch ($layoutType) {
    case 'A': // Простая верстка текстом
      foreach ($results as $x => $y) {
        $output .= "f($x)=$y<br>\n";
      }
      break;

    case 'B': // Маркированный список
      $output .= "<ul>\n";
      foreach ($results as $x => $y) {
        $output .= "  <li>f($x)=$y</li>\n";
      }
      $output .= "</ul>\n";
      break;

    case 'C': // Нумерованный список
      $output .= "<ol>\n";
      foreach ($results as $x => $y) {
        $output .= "  <li>f($x)=$y</li>\n";
      }
      $output .= "</ol>\n";
      break;

    case 'D': // Табличная верстка
      $output .= "<table style='border-collapse: collapse; width: 100%;'>\n";
      $output .= "  <thead>\n";
      $output .= "    <tr style='background-color: #0a2f1f; color: white;'>\n";
      $output .= "      <th style='border: 1px solid black; padding: 8px;'>№</th>\n";
      $output .= "      <th style='border: 1px solid black; padding: 8px;'>Аргумент (x)</th>\n";
      $output .= "      <th style='border: 1px solid black; padding: 8px;'>Значение f(x)</th>\n";
      $output .= "    </tr>\n";
      $output .= "  </thead>\n";
      $output .= "  <tbody>\n";
      foreach ($results as $x => $y) {
        $output .= "    <tr>\n";
        $output .= "      <td style='border: 1px solid black; padding: 8px; text-align: center;'>{$index}</td>\n";
        $output .= "      <td style='border: 1px solid black; padding: 8px;'>{$x}</td>\n";
        $output .= "      <td style='border: 1px solid black; padding: 8px;'>{$y}</td>\n";
        $output .= "    </tr>\n";
        $index++;
      }
      $output .= "  </tbody>\n";
      $output .= "</table>\n";
      break;

    case 'E': // Блочная верстка (горизонтальная)
      $output .= "<div style='display: flex; flex-wrap: wrap; gap: 8px;'>\n";
      foreach ($results as $x => $y) {
        $output .= "  <div style='border: 2px solid red; padding: 10px; margin: 0;'>";
        $output .= "f($x)=$y";
        $output .= "</div>\n";
      }
      $output .= "</div>\n";
      break;

    default:
      $output = "<p style='color: red;'>Ошибка: неизвестный тип вёрстки '$layoutType'</p>";
  }

  return $output;
}
?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Агаев Арслан 241-353 ЛР-2 Вариант 1</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header><img src="./logo.png" alt="" width="90"> <span>Агаев Арслан 241-353 ЛР-2 Вариант 1</span></header>

  <main>
    <h1>Лабораторная работа №2</h1>
    <p>Вычисление значений функции с заданными параметрами</p>

    <div class="info-badge">
      📊 Параметры: x₀ = <?= $startValue ?>, шаг = <?= $step ?>,
      количество = <?= $countValues ?>,
      ограничения: f(x) ∈ [<?= $minFunction ?>, <?= $maxFunction ?>]
    </div>

    <?php if (empty($results)): ?>
      <div style="background: #ffe0b3; padding: 20px; border-radius: 10px;">
        ⚠️ Нет результатов вычислений. Проверьте начальные параметры.
      </div>
    <?php else: ?>
      <!-- Вывод результатов в зависимости от типа вёрстки -->
      <div style="margin: 30px 0;">
        <h2>Результаты вычислений (тип вёрстки: <?= $layoutType ?>)</h2>
        <?= renderResults($results, $layoutType) ?>
      </div>

      <!-- Статистика -->
      <div class="stats">
        <h3>📈 Статистика значений функции</h3>
        <div class="stats-grid">
          <div class="stat-card">
            <div class="label">Максимум</div>
            <div class="value"><?= round($maxValue, 3) ?></div>
          </div>
          <div class="stat-card">
            <div class="label">Минимум</div>
            <div class="value"><?= round($minValue, 3) ?></div>
          </div>
          <div class="stat-card">
            <div class="label">Среднее арифметическое</div>
            <div class="value"><?= round($average, 3) ?></div>
          </div>
          <div class="stat-card">
            <div class="label">Сумма</div>
            <div class="value"><?= round($sum, 3) ?></div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </main>

  <footer>
    <span>© copyright 2026</span>
    <span>Тип вёрстки: <?= $layoutType ?></span>
  </footer>
</body>

</html>