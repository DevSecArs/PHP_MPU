<?php

function utf8_first_char($str)
{
    if (empty($str)) return '';

    // Код первого байта определяет длину символа в UTF-8
    $code = ord($str[0]);

    if ($code < 0x80) {
        // ASCII символ (1 байт)
        return $str[0];
    } elseif ($code < 0xE0) {
        // 2-байтовый символ
        return substr($str, 0, 2);
    } elseif ($code < 0xF0) {
        // 3-байтовый символ (кириллица в UTF-8)
        return substr($str, 0, 3);
    } else {
        // 4-байтовый символ (эмодзи и т.д.)
        return substr($str, 0, 4);
    }
}

function getDeleteContent($pdo)
{
    $message = '';

    // Обработка удаления
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

        // Получаем фамилию перед удалением
        $stmt = $pdo->prepare("SELECT lastname FROM contacts WHERE id = ?");
        $stmt->execute([$delete_id]);
        $contact = $stmt->fetch();

        if ($contact) {
            try {
                $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
                $stmt->execute([$delete_id]);
                $message = '<div class="success-message">Запись с фамилией ' . htmlspecialchars($contact['lastname']) . ' удалена</div>';
            } catch (PDOException $e) {
                $message = '<div class="error-message">Ошибка при удалении записи</div>';
            }
        }
    }

    // Получение списка контактов
    $stmt = $pdo->query("SELECT id, lastname, firstname, middlename FROM contacts ORDER BY lastname ASC");
    $contacts = $stmt->fetchAll();

    // Формирование HTML
    $html = '<h2>Удаление записи</h2>';

    if ($message) {
        $html .= $message;
    }

    if (count($contacts) > 0) {
        $html .= '<ul class="contact-list">';
        foreach ($contacts as $contact) {
            // Формируем инициалы
            $initials = $contact['firstname'] ? utf8_first_char($contact['firstname']) . '.' : '';
            $initials .= $contact['middlename'] ? utf8_first_char($contact['middlename']) . '.' : '';

            $full_name = $contact['lastname'] . ' ' . $initials;

            $html .= '<li><a href="?menu=delete&delete_id=' . $contact['id'] . '">' . htmlspecialchars($full_name) . '</a></li>';
        }
        $html .= '</ul>';
    } else {
        $html .= '<p>Нет записей для удаления.</p>';
    }

    return $html;
}
