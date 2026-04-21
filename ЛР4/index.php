<?php
// Init ============
$tables = [
  "",
  "Бренд*Модель*Кузов#Audi*RS7*C8#Mercedes-Benz*S63 AMG*W223#Porsche*911 Turbo S*992",
  "Бренд*Модель*Чипсет#Apple*iPhone 15 Pro Max*A17 Pro#Samsung*Galaxy S24 Ultra*Snapdragon 8 Gen 3#Xiaomi*13T Pro*Dimensity 9200+",
  "Язык*Типизация*Основное применение#Python*Динамическая*Data Science#Rust*Статическая*Системное программирование#JavaScript*Динамическая*Веб-фронтенд",
  "Страна*Город*Главная достопримечательность#Италия*Рим*Колизей#Франция*Париж*Эйфелева башня#Япония*Токио*Переход Сибуя",
  "Франшиза*Фильм*Год выхода#DC*Тёмный рыцарь*2008#Marvel*Мстители: Финал*2019#Джон Уик*Джон Уик 4*2023",
  "Клуб*Город*Главный трофей#Реал Мадрид*Мадрид*Лига чемпионов#Бавария*Мюнхен*Бундеслига#Ливерпуль*Ливерпуль*АПЛ",
  "Название*Тип*Крепость#Арабика*Односортной*Средняя#Робуста*Смесь*Высокая#Эспрессо*Способ заваривания*Очень высокая",
  "ОС*Семейство*Менеджер пакетов#Ubuntu*Debian*APT#Fedora*Red Hat*DNF#Arch Linux*Rolling release*Pacman",
  "Сорт*Страна*Тип молока#Камамбер*Франция*Коровье#Пармезан*Италия*Коровье#Рокфор*Франция*Овечье"
];

$cols_number = 4;
// ==================

function format_tr($row, $cols_number)
{
  $cols = explode("*", $row);

  if (count($cols) == 1 && $cols[0] == "") {
    return "";
  }

  $html_row = "<tr>";
  for ($i = 0; $i < $cols_number; $i++) {
    if (isset($cols[$i])) {
      $html_row .= "<td>" . $cols[$i] . "</td>";
    } else {
      $html_row .= "<td></td>";
    }
  }
  $html_row .= "</tr>";
  return $html_row;
}

function display_tables($tables, $cols_number)
{
  $count = 1;
  $result = "";
  if ($cols_number <= 0) {
    return "<h1>Неправильное число колонок.</h1>";
  }
  foreach ($tables as $table) {
    $result .= "<h2>Таблица №" . $count . "</h2>";

    $rows = explode('#', $table);
    if (count($rows) == 1 && $rows[0] == "") {
      $result .= "<h1>В таблице нет строк</h1>";
      $count++;
      continue;
    }

    $html_table = "<table>";

    foreach ($rows as $row) {
      $html_table .= format_tr($row, $cols_number);
    }

    $html_table .= "</table>";

    if ($html_table === "<table></table>") {
      $result .= "<h1>В таблице нет строк с ячейками</h1>";
    } else {
      $result .= $html_table;
    }
    $count++;
  }
  return $result;
}

?>
<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Агаев Арслан 241-353 ЛР-4 Вариант 1</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header><img src="./logo.png" alt="" width="90"><span>Агаев Арслан 241-353 ЛР-4 Вариант 1</span></header>
  <main>
    <?php echo display_tables($tables, $cols_number); ?>
  </main>
  <footer>
    <span>@copyright 2026</span>
    <span>Moscow Polytech</span>
  </footer>
</body>

</html>