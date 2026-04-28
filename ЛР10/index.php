<?php
session_start();

// Инициализация истории вычислений
if (!isset($_SESSION['history'])) {
  $_SESSION['history'] = [];
}
if (!isset($_SESSION['iteration'])) {
  $_SESSION['iteration'] = 0;
}
$_SESSION['iteration']++;

$result = '';
$error = '';
$expression = '';

// Проверка, является ли строка числом (без использования готовых функций)
function isnum($x)
{
  // Проверяем, не пустая ли строка
  if (strlen($x) == 0) return false;

  // Если передано не строковое значение, а число — сразу возвращаем true
  // (результаты вычислений в PHP могут быть int или float)
  if (is_int($x) || is_float($x)) return true;

  // Проверяем отрицательные числа
  $start = 0;
  if ($x[0] == '-') {
    if (strlen($x) == 1) return false; // просто минус — не число
    $start = 1;
  }

  // Число не может начинаться с точки
  if ($x[$start] == '.' && ($start == 0 || $start == 1)) return false;

  // Число не может заканчиваться точкой
  if ($x[strlen($x) - 1] == '.') return false;

  $point_count = false;
  for ($i = $start; $i < strlen($x); $i++) {
    $char = $x[$i];
    if (
      $char != '0' && $char != '1' && $char != '2' && $char != '3' &&
      $char != '4' && $char != '5' && $char != '6' && $char != '7' &&
      $char != '8' && $char != '9' && $char != '.'
    ) {
      return false;
    }
    if ($char == '.') {
      if ($point_count) return false;
      $point_count = true;
    }
  }
  return true;
}

// Ручное разбиение строки по разделителю (аналог explode)
function manualExplode($delimiter, $string)
{
  $result = [];
  $current = '';
  for ($i = 0; $i < strlen($string); $i++) {
    if ($string[$i] == $delimiter) {
      $result[] = $current;
      $current = '';
    } else {
      $current .= $string[$i];
    }
  }
  $result[] = $current;
  return $result;
}

// Поиск позиции символа в строке (аналог strpos)
function manualStrpos($haystack, $needle)
{
  for ($i = 0; $i < strlen($haystack); $i++) {
    if ($haystack[$i] == $needle) {
      return $i;
    }
  }
  return false;
}

// Извлечение подстроки (аналог substr)
function manualSubstr($string, $start, $length = null)
{
  $result = '';
  $end = ($length !== null) ? $start + $length : strlen($string);
  for ($i = $start; $i < $end && $i < strlen($string); $i++) {
    $result .= $string[$i];
  }
  return $result;
}

// Вычисление выражения без скобок
function calculate($val)
{
  if (strlen($val) == 0) return 'Выражение не задано!';

  // Заменяем двоеточие на слеш для деления
  $new_val = '';
  for ($i = 0; $i < strlen($val); $i++) {
    if ($val[$i] == ':') {
      $new_val .= '/';
    } else {
      $new_val .= $val[$i];
    }
  }
  $val = $new_val;

  if (isnum($val)) return $val;

  // Обработка сложения (самый низкий приоритет)
  $args = manualExplode('+', $val);
  if (count($args) > 1) {
    $sum = 0;
    for ($i = 0; $i < count($args); $i++) {
      $arg = calculate($args[$i]);
      if (!isnum($arg)) return $arg;
      $sum += $arg;
    }
    return $sum;
  }

  // Обработка вычитания
  $args = manualExplode('-', $val);
  if (count($args) > 1) {
    $arg = calculate($args[0]);
    if (!isnum($arg)) return $arg;
    $sub = $arg;
    for ($i = 1; $i < count($args); $i++) {
      $arg = calculate($args[$i]);
      if (!isnum($arg)) return $arg;
      $sub -= $arg;
    }
    return $sub;
  }

  // Обработка умножения
  $args = manualExplode('*', $val);
  if (count($args) > 1) {
    $sup = 1;
    for ($i = 0; $i < count($args); $i++) {
      $arg = calculate($args[$i]);
      if (!isnum($arg)) return $arg;
      $sup *= $arg;
    }
    return $sup;
  }

  // Обработка деления
  $args = manualExplode('/', $val);
  if (count($args) > 1) {
    $arg = calculate($args[0]);
    if (!isnum($arg)) return $arg;
    $div = $arg;
    for ($i = 1; $i < count($args); $i++) {
      $arg = calculate($args[$i]);
      if (!isnum($arg)) return $arg;
      if ($arg == 0) return 'Деление на ноль!';
      $div /= $arg;
    }
    return $div;
  }

  return 'Недопустимые символы в выражении';
}

// Проверка корректности расстановки скобок
function SqValidator($val)
{
  $open = 0;
  for ($i = 0; $i < strlen($val); $i++) {
    if ($val[$i] == '(') {
      $open++;
    } elseif ($val[$i] == ')') {
      $open--;
      if ($open < 0) return false;
    }
  }
  return $open === 0;
}

// Вычисление выражения со скобками
function calculateSq($val)
{
  if (!SqValidator($val)) return 'Неправильная расстановка скобок';

  $start = manualStrpos($val, '(');
  if ($start === false) {
    return calculate($val);
  }

  // Ищем соответствующую закрывающуюся скобку
  $end = $start + 1;
  $open = 1;
  while ($open && $end < strlen($val)) {
    if ($val[$end] == '(') $open++;
    if ($val[$end] == ')') $open--;
    $end++;
  }

  // Формируем новое выражение
  $new_val = manualSubstr($val, 0, $start); // часть левее скобок
  $new_val .= calculateSq(manualSubstr($val, $start + 1, $end - $start - 2)); // выражение в скобках
  $new_val .= manualSubstr($val, $end); // часть правее скобок

  return calculateSq($new_val);
}

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['val'])) {
  $expression = trim($_POST['val']);

  // Проверка на повторную отправку при обновлении страницы
  if (isset($_POST['iteration']) && $_POST['iteration'] + 1 == $_SESSION['iteration']) {
    $res = calculateSq($expression);

    if (isnum($res)) {
      $result = $res;
      $_SESSION['history'][] = $_POST['val'] . ' = ' . $res;
    } else {
      $error = $res;
      $_SESSION['history'][] = $_POST['val'] . ' = ' . $res . ' (ошибка)';
    }
  }
}
?>
<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Агаев Арслан 241-353 ЛР-10 Вариант 1</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header><img src="./logo.png" alt="" width="90"><span>Агаев Арслан 241-353 ЛР-10 Вариант 1</span></header>

  <main>
    <h1>Арифметический калькулятор</h1>

    <form method="POST" action="" style="margin: 30px 0;">
      <input type="hidden" name="iteration" value="<?php echo $_SESSION['iteration']; ?>">
      <div style="display: flex; gap: 10px; justify-content: center; align-items: center; flex-wrap: wrap;">
        <input
          type="text"
          name="val"
          value="<?php echo htmlspecialchars($expression); ?>"
          placeholder="Введите выражение, например: 2 + 3 * (4 - 1)"
          style="padding: 10px; font-size: 16px; width: 400px; max-width: 80vw; border: 2px solid #0a2f1f; border-radius: 8px;"
          required>
        <button
          type="submit"
          style="padding: 10px 20px; font-size: 16px; background-color: #0a2f1f; color: white; border: none; border-radius: 8px; cursor: pointer;">
          Вычислить
        </button>
      </div>
    </form>

    <!-- Отображение результата или ошибки -->
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['val']) && $_POST['iteration'] + 1 == $_SESSION['iteration']): ?>
      <div style="margin: 20px 0; padding: 15px; background-color: <?php echo $error ? '#ffe6e6' : '#e6ffe6'; ?>; border-radius: 10px; max-width: 500px; margin-left: auto; margin-right: auto;">
        <h2 style="margin: 0; color: <?php echo $error ? '#cc0000' : '#006600'; ?>;">
          <?php if ($error): ?>
            Ошибка: <?php echo htmlspecialchars($error); ?>
          <?php else: ?>
            Результат: <?php echo htmlspecialchars($expression); ?> = <?php echo htmlspecialchars($result); ?>
          <?php endif; ?>
        </h2>
      </div>
    <?php endif; ?>

    <!-- История вычислений -->
    <?php if (!empty($_SESSION['history'])): ?>
      <div style="margin-top: 40px; text-align: left; max-width: 600px; margin-left: auto; margin-right: auto;">
        <h2>История вычислений:</h2>
        <div style="background: #f9fbf9; border-radius: 10px; padding: 15px; border: 1px solid #e0e8e2;">
          <?php for ($i = count($_SESSION['history']) - 1; $i >= 0; $i--): ?>
            <div style="padding: 8px 0; border-bottom: 1px solid #e0e8e2;">
              <?php echo htmlspecialchars($_SESSION['history'][$i]); ?>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    <?php endif; ?>
  </main>

  <footer>@copyright 2026</footer>
</body>

</html>