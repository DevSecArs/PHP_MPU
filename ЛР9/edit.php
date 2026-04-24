<?php
function getEditContent($pdo)
{
    $message = '';
    $selected_contact = null;

    // Получение списка контактов для выбора
    $stmt = $pdo->query("SELECT id, lastname, firstname FROM contacts ORDER BY lastname ASC, firstname ASC");
    $contacts = $stmt->fetchAll();

    // Определение выбранного контакта
    $selected_id = $_GET['edit_id'] ?? ($contacts[0]['id'] ?? null);

    // Получение данных выбранного контакта
    if ($selected_id) {
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->execute([$selected_id]);
        $selected_contact = $stmt->fetch();
    }

    // Обработка POST-запроса на обновление
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_contact'])) {
        $id = $_POST['id'] ?? null;
        $lastname = $_POST['lastname'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $middlename = $_POST['middlename'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $birthdate = $_POST['birthdate'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $email = $_POST['email'] ?? '';
        $comment = $_POST['comment'] ?? '';

        if ($id && !empty($lastname) && !empty($firstname)) {
            try {
                $stmt = $pdo->prepare("UPDATE contacts SET lastname=?, firstname=?, middlename=?, gender=?, birthdate=?, phone=?, address=?, email=?, comment=? WHERE id=?");
                $stmt->execute([$lastname, $firstname, $middlename, $gender, $birthdate, $phone, $address, $email, $comment, $id]);

                $message = '<div class="success-message">Запись успешно обновлена</div>';

                // Обновляем данные выбранного контакта
                $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
                $stmt->execute([$id]);
                $selected_contact = $stmt->fetch();
            } catch (PDOException $e) {
                $message = '<div class="error-message">Ошибка при обновлении записи</div>';
            }
        } else {
            $message = '<div class="error-message">Заполните обязательные поля</div>';
        }
    }

    // Формирование HTML
    $html = '<h2>Редактирование записи</h2>';

    // Список контактов
    if (count($contacts) > 0) {
        $html .= '<ul class="contact-list">';
        foreach ($contacts as $contact) {
            $current_class = ($contact['id'] == $selected_id) ? ' current' : '';
            $html .= '<li><a href="?menu=edit&edit_id=' . $contact['id'] . '" class="' . $current_class . '">' . htmlspecialchars($contact['lastname'] . ' ' . $contact['firstname']) . '</a></li>';
        }
        $html .= '</ul>';

        // Форма редактирования
        if ($selected_contact) {
            $html .= $message;

            $html .= '<form method="post" action="?menu=edit&edit_id=' . $selected_id . '">';
            $html .= '<input type="hidden" name="id" value="' . $selected_contact['id'] . '">';

            $html .= '<div class="form-group">';
            $html .= '<label for="lastname">Фамилия *</label>';
            $html .= '<input type="text" id="lastname" name="lastname" required value="' . htmlspecialchars($_POST['lastname'] ?? $selected_contact['lastname']) . '">';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label for="firstname">Имя *</label>';
            $html .= '<input type="text" id="firstname" name="firstname" required value="' . htmlspecialchars($_POST['firstname'] ?? $selected_contact['firstname']) . '">';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label for="middlename">Отчество</label>';
            $html .= '<input type="text" id="middlename" name="middlename" value="' . htmlspecialchars($_POST['middlename'] ?? $selected_contact['middlename']) . '">';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label for="gender">Пол</label>';
            $html .= '<select id="gender" name="gender">';
            $current_gender = $_POST['gender'] ?? $selected_contact['gender'];
            $selected_male = ($current_gender === 'Мужской') ? ' selected' : '';
            $selected_female = ($current_gender === 'Женский') ? ' selected' : '';
            $html .= '<option value="Мужской"' . $selected_male . '>Мужской</option>';
            $html .= '<option value="Женский"' . $selected_female . '>Женский</option>';
            $html .= '</select>';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label for="birthdate">Дата рождения</label>';
            $html .= '<input type="date" id="birthdate" name="birthdate" value="' . htmlspecialchars($_POST['birthdate'] ?? $selected_contact['birthdate']) . '">';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label for="phone">Телефон</label>';
            $html .= '<input type="tel" id="phone" name="phone" value="' . htmlspecialchars($_POST['phone'] ?? $selected_contact['phone']) . '">';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label for="email">E-mail</label>';
            $html .= '<input type="email" id="email" name="email" value="' . htmlspecialchars($_POST['email'] ?? $selected_contact['email']) . '">';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label for="address">Адрес</label>';
            $html .= '<input type="text" id="address" name="address" value="' . htmlspecialchars($_POST['address'] ?? $selected_contact['address']) . '">';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label for="comment">Комментарий</label>';
            $html .= '<textarea id="comment" name="comment">' . htmlspecialchars($_POST['comment'] ?? $selected_contact['comment']) . '</textarea>';
            $html .= '</div>';

            $html .= '<button type="submit" name="edit_contact" class="submit-btn">Сохранить изменения</button>';
            $html .= '</form>';
        }
    } else {
        $html .= '<p>Нет записей для редактирования.</p>';
    }

    return $html;
}
