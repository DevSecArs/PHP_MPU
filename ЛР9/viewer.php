<?php
function getViewContent($pdo, $sort_type, $page)
{
    // Определение поля сортировки
    $sort_field = 'id';
    $sort_order = 'ASC';

    switch ($sort_type) {
        case 'lastname':
            $sort_field = 'lastname';
            $sort_order = 'ASC';
            break;
        case 'birthdate':
            $sort_field = 'birthdate';
            $sort_order = 'ASC';
            break;
        case 'id':
        default:
            $sort_field = 'id';
            $sort_order = 'ASC';
    }

    // Получение общего количества записей
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM contacts");
    $total_records = $stmt->fetch()['total'];

    // Расчет пагинации
    $records_per_page = 10;
    $total_pages = ceil($total_records / $records_per_page);

    // Проверка корректности номера страницы
    if ($page < 1) $page = 1;
    if ($page > $total_pages && $total_pages > 0) $page = $total_pages;

    $offset = ($page - 1) * $records_per_page;

    // Получение записей
    $stmt = $pdo->prepare("SELECT * FROM contacts ORDER BY $sort_field $sort_order LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $contacts = $stmt->fetchAll();

    // Формирование HTML
    $html = '<h2>Просмотр контактов</h2>';

    if (count($contacts) > 0) {
        $html .= '<table>';
        $html .= '<thead><tr>';
        $html .= '<th>№</th>';
        $html .= '<th>Фамилия</th>';
        $html .= '<th>Имя</th>';
        $html .= '<th>Отчество</th>';
        $html .= '<th>Пол</th>';
        $html .= '<th>Дата рождения</th>';
        $html .= '<th>Телефон</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>Адрес</th>';
        $html .= '<th>Комментарий</th>';
        $html .= '</tr></thead><tbody>';

        foreach ($contacts as $num => $contact) {
            $row_num = $offset + $num + 1;
            $html .= '<tr>';
            $html .= '<td>' . $row_num . '</td>';
            $html .= '<td>' . htmlspecialchars($contact['lastname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($contact['firstname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($contact['middlename']) . '</td>';
            $html .= '<td>' . htmlspecialchars($contact['gender']) . '</td>';
            $html .= '<td>' . htmlspecialchars($contact['birthdate']) . '</td>';
            $html .= '<td>' . htmlspecialchars($contact['phone']) . '</td>';
            $html .= '<td>' . htmlspecialchars($contact['email']) . '</td>';
            $html .= '<td>' . htmlspecialchars($contact['address']) . '</td>';
            $html .= '<td>' . htmlspecialchars($contact['comment']) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        // Пагинация
        if ($total_pages > 1) {
            $html .= '<div class="pagination">';

            for ($i = 1; $i <= $total_pages; $i++) {
                $active_class = ($i == $page) ? ' active' : '';
                $html .= '<a href="?menu=view&sort=' . $sort_type . '&page=' . $i . '" class="' . $active_class . '">' . $i . '</a>';
            }

            $html .= '</div>';
        }
    } else {
        $html .= '<p>Нет записей в базе данных.</p>';
    }

    return $html;
}
