<?php
// Устанавливаем неограниченное время выполнения для больших массивов (на всякий случай)
set_time_limit(0);

// Функция для проверки, является ли строка числом (целым или дробным)
function isNumber($value)
{
    return is_numeric(str_replace(',', '.', $value));
}

// Получаем данные
$rawArray = $_POST['array'] ?? [];
$algorithm = $_POST['algorithm'] ?? '';

// Преобразуем в числа, убираем пустые строки
$inputValues = [];
foreach ($rawArray as $val) {
    $trimmed = trim($val);
    if ($trimmed !== '') {
        $inputValues[] = $trimmed;
    }
}

// Проверка наличия данных
$hasData = count($inputValues) > 0;
$allNumbers = true;
$numbersArray = [];

if ($hasData) {
    foreach ($inputValues as $val) {
        if (isNumber($val)) {
            // Приводим к float, чтобы поддерживать дробные, но для отображения оставим как есть или преобразуем в нужный формат
            $numbersArray[] = (float)str_replace(',', '.', $val);
        } else {
            $allNumbers = false;
            break;
        }
    }
}

// Названия алгоритмов для отображения
$algoNames = [
    'selection' => 'Сортировка выбором',
    'bubble' => 'Пузырьковый алгоритм',
    'shell' => 'Алгоритм Шелла',
    'gnome' => 'Алгоритм садового гнома',
    'quick' => 'Быстрая сортировка',
    'php' => 'Встроенная функция PHP (sort)'
];
$algoTitle = $algoNames[$algorithm] ?? 'Неизвестный алгоритм';

// Функция для вывода состояния
function printState($iteration, $array, $comment = '')
{
    echo "<div class='iteration'>";
    echo "<span class='iter-num'>#{$iteration}</span> ";
    echo "<span class='array-state'>[ " . implode(' ', $array) . " ]</span>";
    if ($comment) {
        echo " <span class='comment'>// {$comment}</span>";
    }
    echo "</div>";
}

// Класс-обертка для хранения номера итерации и времени
class SortTracker
{
    public $iteration = 0;
    public $startTime = 0;
    public $array = [];

    public function start(&$arr)
    {
        $this->array = &$arr; // работаем по ссылке, чтобы отслеживать изменения
        $this->startTime = microtime(true);
        $this->iteration = 0;
    }

    public function nextIteration($comment = '')
    {
        $this->iteration++;
        printState($this->iteration, $this->array, $comment);
        // Небольшая задержка для наглядности (если массив огромный, может тормозить, но для ЛР норм)
        // flush(); ob_flush(); // можно включить для стриминга, но не обязательно
    }

    public function finish()
    {
        $endTime = microtime(true);
        $timeSpent = $endTime - $this->startTime;
        echo "<div class='summary'>";
        echo "<p>✅ Сортировка завершена, проведено <strong>{$this->iteration}</strong> итераций.<br>";
        echo "⏱️ Сортировка заняла <strong>" . number_format($timeSpent, 6) . "</strong> секунд.</p>";
        echo "</div>";
    }
}

$tracker = new SortTracker();

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Результат сортировки</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            padding-top: 110px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .algo-header {
            background: #0a2f1f;
            color: white;
            padding: 15px 25px;
            border-radius: 50px;
            margin-bottom: 25px;
        }

        .algo-header h1 {
            color: white;
        }

        .input-data {
            background: #f0f5f2;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .error {
            background: #ffebee;
            color: #b71c1c;
            padding: 20px;
            border-radius: 15px;
            border-left: 5px solid #b71c1c;
        }

        .iteration {
            font-family: 'Courier New', monospace;
            padding: 8px 15px;
            border-bottom: 1px solid #d0ddd6;
            background: white;
            margin: 2px 0;
            border-radius: 5px;
        }

        .iter-num {
            display: inline-block;
            min-width: 60px;
            color: #0a2f1f;
            font-weight: bold;
        }

        .array-state {
            color: #1e3a2a;
        }

        .comment {
            color: #6b7c73;
            font-style: italic;
        }

        .summary {
            margin-top: 30px;
            padding: 20px;
            background: #e8f0ec;
            border-radius: 20px;
            font-size: 1.2rem;
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            color: #0a2f1f;
        }
    </style>
</head>

<body>
    <header>
        <img src="./logo.png" alt="" width="90">
        <span>Агаев Арслан 241-353 ЛР-7 Вариант 1</span>
    </header>

    <main>
        <div class="container">
            <div class="algo-header">
                <h1>📊 Алгоритм: <?php echo $algoTitle; ?></h1>
            </div>

            <div class="input-data">
                <strong>Входные данные:</strong>
                <?php
                if ($hasData) {
                    echo '[ ' . implode(' ', $inputValues) . ' ]';
                } else {
                    echo '<em>отсутствуют</em>';
                }
                ?>
            </div>

            <?php if (!$hasData): ?>
                <div class="error">
                    ⚠️ Входные данные отсутствуют. Сортировка не выполняется.
                </div>
            <?php elseif (!$allNumbers): ?>
                <div class="error">
                    ⚠️ Среди элементов массива есть не числа. Сортировка не выполняется.
                </div>
            <?php else: ?>
                <h2>🔄 Процесс сортировки:</h2>
                <div class="iterations-container">
                    <?php
                    $arr = $numbersArray; // копия для работы
                    $n = count($arr);
                    $tracker->start($arr);

                    // Выводим начальное состояние как итерацию 0 (или можно считать первой)
                    // По условию "в процессе сортировки выводится информация о каждой итерации", 
                    // выведем начальное состояние перед началом как "Исходный массив"
                    echo "<div class='iteration' style='background:#eef3f0;'><span class='iter-num'>#0</span> <span class='array-state'>[ " . implode(' ', $arr) . " ]</span> <span class='comment'>// Исходный массив</span></div>";

                    switch ($algorithm) {
                        case 'selection':
                            // Сортировка выбором
                            for ($i = 0; $i < $n - 1; $i++) {
                                $minIdx = $i;
                                for ($j = $i + 1; $j < $n; $j++) {
                                    if ($arr[$j] < $arr[$minIdx]) {
                                        $minIdx = $j;
                                    }
                                    $tracker->nextIteration();
                                }
                                if ($minIdx != $i) {
                                    $temp = $arr[$i];
                                    $arr[$i] = $arr[$minIdx];
                                    $arr[$minIdx] = $temp;
                                }
                                $tracker->nextIteration();
                            }
                            break;

                        case 'bubble':
                            // Пузырьковая сортировка
                            for ($i = 0; $i < $n - 1; $i++) {
                                $swapped = false;
                                for ($j = 0; $j < $n - $i - 1; $j++) {
                                    if ($arr[$j] > $arr[$j + 1]) {
                                        $temp = $arr[$j];
                                        $arr[$j] = $arr[$j + 1];
                                        $arr[$j + 1] = $temp;
                                        $swapped = true;
                                    }
                                    $tracker->nextIteration();
                                }
                                $tracker->nextIteration();
                                if (!$swapped) break;
                            }
                            break;

                        case 'shell':
                            // Алгоритм Шелла
                            $gap = floor($n / 2);
                            while ($gap > 0) {
                                for ($i = $gap; $i < $n; $i++) {
                                    $temp = $arr[$i];
                                    $j = $i;
                                    while ($j >= $gap && $arr[$j - $gap] > $temp) {
                                        $arr[$j] = $arr[$j - $gap];
                                        $j -= $gap;
                                        $tracker->nextIteration();
                                    }
                                    $arr[$j] = $temp;
                                    $tracker->nextIteration();
                                }
                                $gap = floor($gap / 2);
                                $tracker->nextIteration();
                            }
                            break;

                        case 'gnome':
                            // Гномья сортировка
                            $i = 1;
                            $j = 2;
                            while ($i < $n) {
                                if ($arr[$i - 1] <= $arr[$i]) {
                                    $i = $j;
                                    $j++;
                                } else {
                                    $temp = $arr[$i];
                                    $arr[$i] = $arr[$i - 1];
                                    $arr[$i - 1] = $temp;
                                    $i--;
                                    if ($i == 0) {
                                        $i = $j;
                                        $j++;
                                    }
                                }
                                $tracker->nextIteration();
                            }
                            break;

                        case 'quick':
                            // Быстрая сортировка (рекурсивная)
                            $quickSort = function (&$arr, $low, $high) use (&$quickSort, $tracker) {
                                if ($low < $high) {
                                    $pivot = $arr[$high];
                                    $i = $low - 1;
                                    for ($j = $low; $j < $high; $j++) {
                                        if ($arr[$j] <= $pivot) {
                                            $i++;
                                            $temp = $arr[$i];
                                            $arr[$i] = $arr[$j];
                                            $arr[$j] = $temp;
                                        }
                                        $tracker->nextIteration();
                                    }
                                    $temp = $arr[$i + 1];
                                    $arr[$i + 1] = $arr[$high];
                                    $arr[$high] = $temp;
                                    $pi = $i + 1;

                                    $tracker->nextIteration();

                                    $quickSort($arr, $low, $pi - 1);
                                    $quickSort($arr, $pi + 1, $high);
                                }
                            };
                            $quickSort($arr, 0, $n - 1);
                            break;

                        case 'php':
                            // Встроенная функция (итераций нет, просто вызываем)
                            sort($arr);
                            $tracker->nextIteration("встроенная сортировка PHP");
                            break;

                        default:
                            echo "<div class='error'>Неизвестный алгоритм</div>";
                    }

                    // Завершаем и выводим итог
                    $tracker->finish();
                    ?>
                </div>
            <?php endif; ?>

            <a href="index.php" class="back-link">← Вернуться к форме</a>
        </div>
    </main>

    <footer>@copyright 2026</footer>
</body>

</html>