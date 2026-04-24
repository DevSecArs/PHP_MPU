<?php
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
            $initials = $contact['firstname'] ? mb_substr($contact['firstname'], 0, 1) . '.' : '';
            $initials .= $contact['middlename'] ? mb_substr($contact['middlename'], 0, 1) . '.' : '';

            $full_name = $contact['lastname'] . ' ' . $initials;

            $html .= '<li><a href="?menu=delete&delete_id=' . $contact['id'] . '">' . htmlspecialchars($full_name) . '</a></li>';
        }
        $html .= '</ul>';
    } else {
        $html .= '<p>Нет записей для удаления.</p>';
    }

    return $html;
}
