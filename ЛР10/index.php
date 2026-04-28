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

// Проверка, является ли строка числом
function isNumberString($x)
{
  if (strlen($x) == 0) return false;

  $start = 0;
  // Разрешаем минус в начале
  if ($x[0] == '-') {
    if (strlen($x) == 1) return false;
    $start = 1;
  }

  // Проверка на пустую строку после минуса
  if ($start >= strlen($x)) return false;

  // Проверка, что после минуса не идёт точка
  if ($x[$start] == '.' && $start == strlen($x) - 1) return false;

  // Число не может заканчиваться точкой
  if ($x[strlen($x) - 1] == '.') return false;

  $point_count = false;
  $has_digit = false;

  for ($i = $start; $i < strlen($x); $i++) {
    $char = $x[$i];
    if (
      $char == '0' || $char == '1' || $char == '2' || $char == '3' ||
      $char == '4' || $char == '5' || $char == '6' || $char == '7' ||
      $char == '8' || $char == '9'
    ) {
      $has_digit = true;
      continue;
    }
    if ($char == '.') {
      if ($point_count) return false;
      $point_count = true;
      continue;
    }
    return false;
  }

  return $has_digit;
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
  // Удаляем пробелы
  $clean_val = '';
  for ($i = 0; $i < strlen($val); $i++) {
    if ($val[$i] != ' ') {
      $clean_val .= $val[$i];
    }
  }
  $val = $clean_val;

  if (strlen($val) == 0) return 'Выражение не задано!';

  if (!SqValidator($val)) return 'Неправильная расстановка скобок';

  // Ищем первую открывающую скобку
  $start = manualStrpos($val, '(');
  if ($start === false) {
    return calculate($val);
  }

  // Ищем соответствующую закрывающую скобку
  $end = $start + 1;
  $open = 1;
  while ($open && $end < strlen($val)) {
    if ($val[$end] == '(') $open++;
    if ($val[$end] == ')') $open--;
    $end++;
  }

  // Формируем новое выражение
  $new_val = manualSubstr($val, 0, $start); // часть левее скобок
  $inner_expr = manualSubstr($val, $start + 1, $end - $start - 2); // выражение внутри скобок
  $inner_result = calculateSq($inner_expr);

  // Если результат внутри скобок — ошибка, возвращаем её
  if (!isNumberString($inner_result)) return $inner_result;

  $new_val .= $inner_result;
  $new_val .= manualSubstr($val, $end); // часть правее скобок

  return calculateSq($new_val);
}

// Вычисление выражения без скобок
function calculate($val)
{
  if (strlen($val) == 0) return 'Выражение не задано!';

  if (isNumberString($val)) return $val;

  // Заменяем двоеточие на слеш
  $new_val = '';
  for ($i = 0; $i < strlen($val); $i++) {
    $new_val .= ($val[$i] == ':') ? '/' : $val[$i];
  }
  $val = $new_val;

  // Обработка сложения
  $args = splitByOperator($val, '+');
  if (count($args) > 1) {
    $sum = 0;
    for ($i = 0; $i < count($args); $i++) {
      $arg = calculate($args[$i]);
      if (!isNumberString($arg)) return $arg;
      $sum += (float)$arg;
    }
    return numberToString($sum);
  }

  // Обработка вычитания
  $args = splitByOperator($val, '-');
  if (count($args) > 1) {
    $arg = calculate($args[0]);
    if (!isNumberString($arg)) return $arg;
    $sub = (float)$arg;
    for ($i = 1; $i < count($args); $i++) {
      $arg = calculate($args[$i]);
      if (!isNumberString($arg)) return $arg;
      $sub -= (float)$arg;
    }
    return numberToString($sub);
  }

  // Обработка умножения
  $args = splitByOperator($val, '*');
  if (count($args) > 1) {
    $sup = 1;
    for ($i = 0; $i < count($args); $i++) {
      $arg = calculate($args[$i]);
      if (!isNumberString($arg)) return $arg;
      $sup *= (float)$arg;
    }
    return numberToString($sup);
  }

  // Обработка деления
  $args = splitByOperator($val, '/');
  if (count($args) > 1) {
    $arg = calculate($args[0]);
    if (!isNumberString($arg)) return $arg;
    $div = (float)$arg;
    for ($i = 1; $i < count($args); $i++) {
      $arg = calculate($args[$i]);
      if (!isNumberString($arg)) return $arg;
      if ((float)$arg == 0) return 'Деление на ноль!';
      $div /= (float)$arg;
    }
    return numberToString($div);
  }

  return 'Недопустимые символы в выражении';
}

// Разбиение строки по оператору с учётом унарного минуса
function splitByOperator($string, $operator)
{
  $result = [];
  $current = '';

  for ($i = 0; $i < strlen($string); $i++) {
    $char = $string[$i];

    if ($char == $operator) {
      // Для минуса проверяем: если это не начало и предыдущий символ — оператор или начало строки с учётом минуса как унарного
      if ($operator == '-') {
        // Если current пустой — это унарный минус
        if ($current == '') {
          $current .= $char;
          continue;
        }
        // Если current заканчивается на оператор — это тоже унарный минус
        $last_char = $current[strlen($current) - 1];
        if ($last_char == '+' || $last_char == '-' || $last_char == '*' || $last_char == '/' || $last_char == '(') {
          $current .= $char;
          continue;
        }
      }

      // Это бинарный оператор — разбиваем
      $result[] = $current;
      $current = '';
    } else {
      $current .= $char;
    }
  }
  $result[] = $current;
  return $result;
}

// Преобразование числа в строку без лишних нулей
function numberToString($num)
{
  // Если число целое
  if ($num == (int)$num) {
    return (string)(int)$num;
  }
  return (string)$num;
}

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['val'])) {
  $expression = trim($_POST['val']);

  if (isset($_POST['iteration']) && $_POST['iteration'] + 1 == $_SESSION['iteration']) {
    $res = calculateSq($expression);

    if (isNumberString($res)) {
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
          placeholder="Введите выражение, например: -3+24*(-3)"
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
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['val']) && isset($_POST['iteration']) && $_POST['iteration'] + 1 == $_SESSION['iteration']): ?>
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