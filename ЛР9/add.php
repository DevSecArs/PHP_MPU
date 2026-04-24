<?php
function getAddContent($pdo)
{
    $message = '';
    $message_type = '';

    // Обработка POST-запроса
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_contact'])) {
        $lastname = $_POST['lastname'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $middlename = $_POST['middlename'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $birthdate = $_POST['birthdate'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $email = $_POST['email'] ?? '';
        $comment = $_POST['comment'] ?? '';

        // Проверка обязательных полей
        if (empty($lastname) || empty($firstname)) {
            $message = 'Ошибка: запись не добавлена';
            $message_type = 'error';
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO contacts (lastname, firstname, middlename, gender, birthdate, phone, address, email, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$lastname, $firstname, $middlename, $gender, $birthdate, $phone, $address, $email, $comment]);

                $message = 'Запись добавлена';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Ошибка: запись не добавлена';
                $message_type = 'error';
            }
        }
    }

    // Формирование HTML формы
    $html = '<h2>Добавление новой записи</h2>';

    if ($message) {
        $message_class = ($message_type === 'success') ? 'success-message' : 'error-message';
        $html .= '<div class="' . $message_class . '">' . $message . '</div>';
    }

    $html .= '<form method="post" action="?menu=add">';
    $html .= '<div class="form-group">';
    $html .= '<label for="lastname">Фамилия *</label>';
    $html .= '<input type="text" id="lastname" name="lastname" required value="' . ($_POST['lastname'] ?? '') . '">';
    $html .= '</div>';

    $html .= '<div class="form-group">';
    $html .= '<label for="firstname">Имя *</label>';
    $html .= '<input type="text" id="firstname" name="firstname" required value="' . ($_POST['firstname'] ?? '') . '">';
    $html .= '</div>';

    $html .= '<div class="form-group">';
    $html .= '<label for="middlename">Отчество</label>';
    $html .= '<input type="text" id="middlename" name="middlename" value="' . ($_POST['middlename'] ?? '') . '">';
    $html .= '</div>';

    $html .= '<div class="form-group">';
    $html .= '<label for="gender">Пол</label>';
    $html .= '<select id="gender" name="gender">';
    $selected_male = (isset($_POST['gender']) && $_POST['gender'] === 'Мужской') ? ' selected' : '';
    $selected_female = (isset($_POST['gender']) && $_POST['gender'] === 'Женский') ? ' selected' : '';
    $html .= '<option value="Мужской"' . $selected_male . '>Мужской</option>';
    $html .= '<option value="Женский"' . $selected_female . '>Женский</option>';
    $html .= '</select>';
    $html .= '</div>';

    $html .= '<div class="form-group">';
    $html .= '<label for="birthdate">Дата рождения</label>';
    $html .= '<input type="date" id="birthdate" name="birthdate" value="' . ($_POST['birthdate'] ?? '') . '">';
    $html .= '</div>';

    $html .= '<div class="form-group">';
    $html .= '<label for="phone">Телефон</label>';
    $html .= '<input type="tel" id="phone" name="phone" value="' . ($_POST['phone'] ?? '') . '">';
    $html .= '</div>';

    $html .= '<div class="form-group">';
    $html .= '<label for="email">E-mail</label>';
    $html .= '<input type="email" id="email" name="email" value="' . ($_POST['email'] ?? '') . '">';
    $html .= '</div>';

    $html .= '<div class="form-group">';
    $html .= '<label for="address">Адрес</label>';
    $html .= '<input type="text" id="address" name="address" value="' . ($_POST['address'] ?? '') . '">';
    $html .= '</div>';

    $html .= '<div class="form-group">';
    $html .= '<label for="comment">Комментарий</label>';
    $html .= '<textarea id="comment" name="comment">' . ($_POST['comment'] ?? '') . '</textarea>';
    $html .= '</div>';

    $html .= '<button type="submit" name="add_contact" class="submit-btn">Добавить запись</button>';
    $html .= '</form>';

    return $html;
}
