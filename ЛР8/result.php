<?php
// TODO: Подсчёт без учёта регистра и кол слов по алфавиту без учёта регистра

// Включаем буферизацию вывода
ob_start();
?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Агаев Арслан 241-353 ЛР-8 Вариант 1 - Результат</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header><img src="./logo.png" alt="" width="90"><span>Агаев Арслан 241-353 ЛР-8 Вариант 1</span></header>
    <main>
        <?php
        // Получаем текст из формы
        $text_utf8 = isset($_POST['usertext']) ? trim($_POST['usertext']) : '';

        // Конвертируем из UTF-8 в CP1251 для обработки
        $text = iconv('UTF-8', 'CP1251//TRANSLIT//IGNORE', $text_utf8);

        // Если текст пустой или конвертация не удалась
        if ($text === false || $text === '') {
            $text = '';
        }

        // Определяем алфавиты в CP1251
        $RUSSIAN_UPPER = 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ';
        $RUSSIAN_LOWER = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя';
        $ENGLISH_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ENGLISH_LOWER = 'abcdefghijklmnopqrstuvwxyz';

        $ALL_LETTERS = $RUSSIAN_UPPER . $RUSSIAN_LOWER . $ENGLISH_UPPER . $ENGLISH_LOWER;
        $ALL_UPPER = $RUSSIAN_UPPER . $ENGLISH_UPPER;
        $ALL_LOWER = $RUSSIAN_LOWER . $ENGLISH_LOWER;

        $DIGITS = '0123456789';
        $PUNCTUATION = '.,!?;:()-—"\'«»[]{}…';

        // Функция для проверки, является ли символ буквой
        function is_letter($char)
        {
            global $ALL_LETTERS;
            return strpos($ALL_LETTERS, $char) !== false;
        }

        // Функция для проверки, является ли символ строчной буквой
        function is_lowercase($char)
        {
            global $ALL_LOWER;
            return strpos($ALL_LOWER, $char) !== false;
        }

        // Функция для проверки, является ли символ заглавной буквой
        function is_uppercase($char)
        {
            global $ALL_UPPER;
            return strpos($ALL_UPPER, $char) !== false;
        }

        // Функция для проверки, является ли символ знаком препинания
        function is_punctuation($char)
        {
            global $PUNCTUATION;
            return strpos($PUNCTUATION, $char) !== false;
        }

        // Функция для проверки, является ли символ цифрой
        function is_digit($char)
        {
            global $DIGITS;
            return strpos($DIGITS, $char) !== false;
        }

        // Функция для проверки, является ли символ разделителем слов
        function is_separator($char)
        {
            return $char == ' ' || $char == "\n" || $char == "\r" || $char == "\t" || is_punctuation($char);
        }

        // Функция для приведения символа к нижнему регистру
        function to_lower($char)
        {
            global $RUSSIAN_UPPER, $RUSSIAN_LOWER, $ENGLISH_UPPER, $ENGLISH_LOWER;

            $pos = strpos($RUSSIAN_UPPER, $char);
            if ($pos !== false) {
                return $RUSSIAN_LOWER[$pos];
            }

            $pos = strpos($ENGLISH_UPPER, $char);
            if ($pos !== false) {
                return $ENGLISH_LOWER[$pos];
            }

            return $char;
        }

        // Функция для приведения символа к нижнему регистру через коды CP1251
        function to_lower_by_code($char)
        {
            $code = ord($char);

            // Русские заглавные буквы в CP1251: 192-223 (кроме 168 - Ё)
            if ($code == 168) return chr(184); // Ё -> ё
            if ($code >= 192 && $code <= 223) return chr($code + 32); // А-Я -> а-я

            // Английские заглавные буквы: 65-90
            if ($code >= 65 && $code <= 90) return chr($code + 32); // A-Z -> a-z

            return $char;
        }

        // Функция для извлечения слов из текста
        function extract_words($text)
        {
            $words = [];
            $current_word = '';
            $len = strlen($text);

            for ($i = 0; $i < $len; $i++) {
                $char = to_lower_by_code($text[$i]);

                // Почему то ему буква В не нравится
                if (is_separator($char) && iconv('CP1251', 'UTF-8//TRANSLIT//IGNORE', $char) != 'в') {
                    echo $i . ' = ' . iconv('CP1251', 'UTF-8//TRANSLIT//IGNORE', $char);
                    if ($current_word !== '') {
                        $words[] = $current_word;
                        $current_word = '';
                    }
                } else {
                    $current_word .= $char;
                }
            }

            if ($current_word !== '') {
                $words[] = $current_word;
            }

            return $words;
        }

        // Подсчёт статистики
        if ($text !== '') {
            $total_chars = strlen($text);
            $letter_count = 0;
            $lower_count = 0;
            $upper_count = 0;
            $punct_count = 0;
            $digit_count = 0;

            $char_freq = [];

            // Проходим по каждому символу
            for ($i = 0; $i < $total_chars; $i++) {
                $char = $text[$i];

                // Подсчёт типов символов
                if (is_letter($char)) {
                    $letter_count++;
                    if (is_lowercase($char)) {
                        $lower_count++;
                    } elseif (is_uppercase($char)) {
                        $upper_count++;
                    }
                } elseif (is_punctuation($char)) {
                    $punct_count++;
                } elseif (is_digit($char)) {
                    $digit_count++;
                }

                // Частота символов (без учёта регистра)
                $lower_char = to_lower_by_code($char);

                if (isset($char_freq[$lower_char])) {
                    $char_freq[$lower_char]++;
                } else {
                    $char_freq[$lower_char] = 1;
                }
            }

            // Сортировка частоты символов
            ksort($char_freq);

            // Работа со словами
            $words = extract_words($text);
            $word_count = count($words);

            $word_freq = [];
            foreach ($words as $word) {
                $lower_word = '';
                $word_len = strlen($word);
                for ($i = 0; $i < $word_len; $i++) {
                    $lower_word .= to_lower($word[$i]);
                }

                if (isset($word_freq[$lower_word])) {
                    $word_freq[$lower_word]++;
                } else {
                    $word_freq[$lower_word] = 1;
                }
            }

            ksort($word_freq);

            // Конвертируем обратно в UTF-8 для вывода
            $text_display = iconv('CP1251', 'UTF-8//TRANSLIT//IGNORE', $text);

            // Конвертируем частоту символов для вывода
            $char_freq_display = [];
            foreach ($char_freq as $char => $count) {
                $char_utf8 = iconv('CP1251', 'UTF-8//TRANSLIT//IGNORE', $char);
                $char_freq_display[$char_utf8] = $count;
            }

            // Конвертируем частоту слов для вывода
            $word_freq_display = [];
            foreach ($word_freq as $word => $count) {
                $word_utf8 = iconv('CP1251', 'UTF-8//TRANSLIT//IGNORE', $word);
                $word_freq_display[$word_utf8] = $count;
            }
        } else {
            $text_display = '';
        }
        ?>

        <h1>Результат анализа</h1>

        <div class="card result-card">
            <h3>Исходный текст</h3>
            <?php if ($text === ''): ?>
                <div class="original-text empty-text">Нет текста для анализа</div>
            <?php else: ?>
                <div class="original-text"><?php echo nl2br(htmlspecialchars($text_display, ENT_QUOTES, 'UTF-8')); ?></div>
            <?php endif; ?>
        </div>

        <?php if ($text !== ''): ?>

            <div class="card">
                <h3>Статистика текста</h3>
                <table>
                    <tr>
                        <th>Параметр</th>
                        <th>Значение</th>
                    </tr>
                    <tr>
                        <td>Количество символов (включая пробелы)</td>
                        <td><?php echo $total_chars; ?></td>
                    </tr>
                    <tr>
                        <td>Количество букв</td>
                        <td><?php echo $letter_count; ?></td>
                    </tr>
                    <tr>
                        <td>Количество строчных букв</td>
                        <td><?php echo $lower_count; ?></td>
                    </tr>
                    <tr>
                        <td>Количество заглавных букв</td>
                        <td><?php echo $upper_count; ?></td>
                    </tr>
                    <tr>
                        <td>Количество знаков препинания</td>
                        <td><?php echo $punct_count; ?></td>
                    </tr>
                    <tr>
                        <td>Количество цифр</td>
                        <td><?php echo $digit_count; ?></td>
                    </tr>
                    <tr>
                        <td>Количество слов</td>
                        <td><?php echo $word_count; ?></td>
                    </tr>
                </table>
            </div>

            <div class="card">
                <h3>Частота символов (без учета регистра)</h3>
                <table>
                    <tr>
                        <th>Символ</th>
                        <th>Количество вхождений</th>
                    </tr>
                    <?php foreach ($char_freq_display as $char => $count): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($char, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo $count; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="card">
                <h3>Частота слов (по алфавиту)</h3>
                <?php if (count($word_freq_display) > 0): ?>
                    <table>
                        <tr>
                            <th>Слово</th>
                            <th>Количество вхождений</th>
                        </tr>
                        <?php foreach ($word_freq_display as $word => $count): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($word, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo $count; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p>Слов не найдено</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="nav-links">
            <a href="index.html" class="button-link">Другой анализ</a>
        </div>
    </main>
    <footer>@copyright 2026</footer>
</body>

</html>
<?php
// Отправляем буфер в браузер
ob_end_flush();
?>