<?php
// Массив с выдуманными данными клиентов
$clients = [
    ['id' => 1, 'name' => 'ООО "ТехноПром"', 'contact' => 'Иван Петров', 'phone' => '+7 (495) 123-45-67', 'email' => 'info@technoprom.ru', 'status' => 'Активный'],
    ['id' => 2, 'name' => 'АО "Цифровые Решения"', 'contact' => 'Елена Смирнова', 'phone' => '+7 (812) 234-56-78', 'email' => 'contact@digitalsolutions.ru', 'status' => 'Активный'],
    ['id' => 3, 'name' => 'ООО "ФинансГарант"', 'contact' => 'Алексей Козлов', 'phone' => '+7 (343) 345-67-89', 'email' => 'info@finansgarant.ru', 'status' => 'Приостановлен'],
    ['id' => 4, 'name' => 'ИП "МедиаСтар"', 'contact' => 'Ольга Новикова', 'phone' => '+7 (383) 456-78-90', 'email' => 'olga@mediastar.ru', 'status' => 'Активный'],
    ['id' => 5, 'name' => 'ООО "ЛогистикПро"', 'contact' => 'Дмитрий Морозов', 'phone' => '+7 (846) 567-89-01', 'email' => 'info@logisticpro.ru', 'status' => 'Заблокирован'],
    ['id' => 6, 'name' => 'АО "СтройИнвест"', 'contact' => 'Сергей Васильев', 'phone' => '+7 (473) 678-90-12', 'email' => 'info@stroyinvest.ru', 'status' => 'Активный'],
    ['id' => 7, 'name' => 'ООО "РитейлГрупп"', 'contact' => 'Мария Павлова', 'phone' => '+7 (831) 789-01-23', 'email' => 'm.pavlova@retailgroup.ru', 'status' => 'Активный'],
    ['id' => 8, 'name' => 'ЧУДО "Образование+"', 'contact' => 'Анна Соколова', 'phone' => '+7 (4012) 890-12-34', 'email' => 'info@obrazplus.ru', 'status' => 'Приостановлен'],
];
?>


<!-- ПРАВИЛЬНАЯ РЕАЛИЗАЦИЯ -->
<div class="clients-table-container" style="margin-top: 40px;">
    <h2>📊 Таблица клиентов (правильная версия)</h2>

    <table class="clients-table">
        <?php
        // ПЕРВАЯ СТРОКА (заголовки) - ПОЛНОСТЬЮ ВЫВОДИТСЯ ЧЕРЕЗ PHP
        echo '<thead><tr>
                <th>ID</th>
                <th>Название компании</th>
                <th>Контактное лицо</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Статус</th>
              </tr></thead>';
        ?>

        <tbody>
            <?php
            // ВТОРАЯ И ПОСЛЕДУЮЩИЕ СТРОКИ
            // Динамически формируется ТОЛЬКО содержимое ячеек (между <td> и </td>)
            // Промежуточные переменные для хранения строк НЕ используются
            ?>

            <!-- Строка 1 - содержимое ячеек генерируется через PHP -->
            <tr>
                <td><?php echo $clients[0]['id']; ?></td>
                <td><?php echo $clients[0]['name']; ?></td>
                <td><?php echo $clients[0]['contact']; ?></td>
                <td><?php echo $clients[0]['phone']; ?></td>
                <td><?php echo $clients[0]['email']; ?></td>
                <td>
                    <?php
                    $status = $clients[0]['status'];
                    if ($status == 'Активный') {
                        echo '<span class="status-active">● Активный</span>';
                    } elseif ($status == 'Приостановлен') {
                        echo '<span class="status-suspended">● Приостановлен</span>';
                    } else {
                        echo '<span class="status-blocked">● Заблокирован</span>';
                    }
                    ?>
                </td>
            </tr>

            <!-- Строка 2 -->
            <tr>
                <td><?php echo $clients[1]['id']; ?></td>
                <td><?php echo $clients[1]['name']; ?></td>
                <td><?php echo $clients[1]['contact']; ?></td>
                <td><?php echo $clients[1]['phone']; ?></td>
                <td><?php echo $clients[1]['email']; ?></td>
                <td><?php echo $clients[1]['status'] == 'Активный' ? '<span class="status-active">● Активный</span>' : '<span class="status-suspended">● Приостановлен</span>'; ?></td>
            </tr>

            <!-- Строка 3 -->
            <tr>
                <td><?php echo $clients[2]['id']; ?></td>
                <td><?php echo $clients[2]['name']; ?></td>
                <td><?php echo $clients[2]['contact']; ?></td>
                <td><?php echo $clients[2]['phone']; ?></td>
                <td><?php echo $clients[2]['email']; ?></td>
                <td><?php echo $clients[2]['status'] == 'Приостановлен' ? '<span class="status-suspended">● Приостановлен</span>' : '<span class="status-blocked">● Заблокирован</span>'; ?></td>
            </tr>

            <!-- Строка 4 -->
            <tr>
                <td><?php echo $clients[3]['id']; ?></td>
                <td><?php echo $clients[3]['name']; ?></td>
                <td><?php echo $clients[3]['contact']; ?></td>
                <td><?php echo $clients[3]['phone']; ?></td>
                <td><?php echo $clients[3]['email']; ?></td>
                <td><?php echo '<span class="status-active">● ' . $clients[3]['status'] . '</span>'; ?></td>
            </tr>

            <!-- Строка 5 -->
            <tr>
                <td><?php echo $clients[4]['id']; ?></td>
                <td><?php echo $clients[4]['name']; ?></td>
                <td><?php echo $clients[4]['contact']; ?></td>
                <td><?php echo $clients[4]['phone']; ?></td>
                <td><?php echo $clients[4]['email']; ?></td>
                <td><?php echo '<span class="status-blocked">● ' . $clients[4]['status'] . '</span>'; ?></td>
            </tr>

            <!-- Строка 6 -->
            <tr>
                <td><?php echo $clients[5]['id']; ?></td>
                <td><?php echo $clients[5]['name']; ?></td>
                <td><?php echo $clients[5]['contact']; ?></td>
                <td><?php echo $clients[5]['phone']; ?></td>
                <td><?php echo $clients[5]['email']; ?></td>
                <td><?php echo $clients[5]['status'] == 'Активный' ? '<span class="status-active">● Активный</span>' : '<span class="status-blocked">● Заблокирован</span>'; ?></td>
            </tr>

            <!-- Строка 7 -->
            <tr>
                <td><?php echo $clients[6]['id']; ?></td>
                <td><?php echo $clients[6]['name']; ?></td>
                <td><?php echo $clients[6]['contact']; ?></td>
                <td><?php echo $clients[6]['phone']; ?></td>
                <td><?php echo $clients[6]['email']; ?></td>
                <td><?php
                    if ($clients[6]['status'] == 'Активный') {
                        echo '<span class="status-active">● Активный</span>';
                    } else {
                        echo '<span class="status-suspended">● Приостановлен</span>';
                    }
                    ?></td>
            </tr>

            <!-- Строка 8 -->
            <tr>
                <td><?php echo $clients[7]['id']; ?></td>
                <td><?php echo $clients[7]['name']; ?></td>
                <td><?php echo $clients[7]['contact']; ?></td>
                <td><?php echo $clients[7]['phone']; ?></td>
                <td><?php echo $clients[7]['email']; ?></td>
                <td><?php echo '<span class="status-suspended">● ' . $clients[7]['status'] . '</span>'; ?></td>
            </tr>
        </tbody>
    </table>

    <div class="table-info">
        <p>📊 Всего клиентов: <strong><?php echo count($clients); ?></strong></p>
        <p>✅ Активных: <strong><?php
                                $active_count = 0;
                                foreach ($clients as $client) {
                                    if ($client['status'] == 'Активный') $active_count++;
                                }
                                echo $active_count;
                                ?></strong></p>
    </div>
</div>

<style>
    .clients-table-container {
        max-width: 1400px;
        margin: 30px auto;
        padding: 0 20px;
        overflow-x: auto;
    }

    .clients-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .clients-table thead tr {
        background-color: #0a2f1f;
        color: white;
    }

    .clients-table th {
        padding: 14px 16px;
        text-align: left;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .clients-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #e0e8e2;
        color: #2c3e32;
    }

    .clients-table tbody tr:hover {
        background-color: #f5f9f6;
        transition: background 0.2s ease;
    }

    .status-active {
        color: #27ae60;
        font-weight: 600;
    }

    .status-suspended {
        color: #f39c12;
        font-weight: 600;
    }

    .status-blocked {
        color: #e74c3c;
        font-weight: 600;
    }

    .btn-edit {
        background: #0a2f1f;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 20px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-edit:hover {
        background: #144d33;
    }

    .table-info {
        margin-top: 20px;
        display: flex;
        gap: 30px;
        padding: 15px 20px;
        background: #f0f4f2;
        border-radius: 12px;
        font-size: 0.9rem;
    }

    .table-info p {
        margin: 0;
    }

    @media (max-width: 768px) {

        .clients-table th,
        .clients-table td {
            padding: 8px 10px;
            font-size: 0.8rem;
        }

        .btn-edit {
            padding: 4px 8px;
        }
    }
</style>