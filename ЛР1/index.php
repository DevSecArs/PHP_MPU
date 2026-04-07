<?php
// В начале файла задаём название страницы
$page_title = 'Главная страница';
?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $page_title; ?> Агаев Арслан 241-353 ЛР 1</title>
    <link rel="stylesheet" href="template.css" />
</head>

<body>
    <?php include 'nav.php'; ?>

    <main class="content-area" style="padding-top: 20px">
        <!-- Hero-секция: заголовок и краткое введение -->
        <section style="text-align: center; margin-bottom: 48px">
            <h1
                style="
            font-size: 2.5rem;
            margin-bottom: 16px;
            border-left: none;
            text-align: center;
          ">
                🛡️ Информационная безопасность
            </h1>
            <p
                style="
            font-size: 1.2rem;
            color: #2c3e32;
            max-width: 800px;
            margin: 0 auto;
          ">
                Защита данных в эпоху цифровых угроз. Комплексный подход к сохранению
                конфиденциальности, целостности и доступности информации.
            </p>
            <div class="badge" style="margin-top: 16px">Актуально на 2026 год</div>
        </section>

        <!-- Сетка основных принципов CIA (Конфиденциальность, Целостность, Доступность) -->
        <div class="card-grid" style="margin-bottom: 48px">
            <div class="card">
                <h3>🔒 Конфиденциальность</h3>
                <p>
                    Доступ к информации только для авторизованных лиц. Защита от утечек,
                    несанкционированного просмотра и перехвата данных.
                </p>
            </div>
            <div class="card">
                <h3>📋 Целостность</h3>
                <p>
                    Гарантия того, что данные не были изменены или уничтожены незаконно.
                    Контроль версий, хеширование и резервное копирование.
                </p>
            </div>
            <div class="card">
                <h3>⚡ Доступность</h3>
                <p>
                    Информация и сервисы доступны легальным пользователям в любое время.
                    Защита от DDoS-атак, сбоев и отказов оборудования.
                </p>
            </div>
        </div>

        <!-- Блок: основные угрозы -->
        <h2>⚠️ Основные угрозы сегодня</h2>
        <div
            style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 48px">
            <div
                style="
            flex: 1;
            min-width: 200px;
            background: #f9fbf9;
            border-radius: 20px;
            padding: 20px;
            border-left: 4px solid #c0392b;
          ">
                <strong style="color: #c0392b">Социальная инженерия</strong>
                <p style="margin-top: 8px">
                    Фишинг, претекстинг, вишинг — манипуляции людьми для получения
                    доступа или данных.
                </p>
            </div>
            <div
                style="
            flex: 1;
            min-width: 200px;
            background: #f9fbf9;
            border-radius: 20px;
            padding: 20px;
            border-left: 4px solid #e67e22;
          ">
                <strong style="color: #e67e22">Вредоносное ПО</strong>
                <p style="margin-top: 8px">
                    Вирусы, трояны, шифровальщики (ransomware), шпионское ПО.
                </p>
            </div>
            <div
                style="
            flex: 1;
            min-width: 200px;
            background: #f9fbf9;
            border-radius: 20px;
            padding: 20px;
            border-left: 4px solid #2980b9;
          ">
                <strong style="color: #2980b9">Атаки на веб-приложения</strong>
                <p style="margin-top: 8px">
                    SQL-инъекции, XSS, CSRF, подбор паролей (bruteforce).
                </p>
            </div>
        </div>

        <!-- Блок: меры защиты (с иконками) -->
        <h2>🛠️ Комплексные меры защиты</h2>
        <div
            style="
          background: #ffffff;
          border-radius: 28px;
          padding: 24px;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
          margin-bottom: 48px;
        ">
            <ul style="list-style-type: none; padding-left: 0">
                <li
                    style="
              margin-bottom: 16px;
              display: flex;
              align-items: flex-start;
              gap: 12px;
            ">
                    <span style="font-size: 1.5rem">🔐</span>
                    <span><strong>Многофакторная аутентификация (MFA)</strong> — пароль +
                        код из приложения / биометрия / SMS.</span>
                </li>
                <li
                    style="
              margin-bottom: 16px;
              display: flex;
              align-items: flex-start;
              gap: 12px;
            ">
                    <span style="font-size: 1.5rem">🧠</span>
                    <span><strong>Обучение персонала</strong> — регулярные тренинги по
                        кибергигиене и распознаванию фишинга.</span>
                </li>
                <li
                    style="
              margin-bottom: 16px;
              display: flex;
              align-items: flex-start;
              gap: 12px;
            ">
                    <span style="font-size: 1.5rem">🖥️</span>
                    <span><strong>Шифрование данных</strong> — как при хранении (на дисках,
                        в базах), так и при передаче (TLS, VPN).</span>
                </li>
                <li
                    style="
              margin-bottom: 16px;
              display: flex;
              align-items: flex-start;
              gap: 12px;
            ">
                    <span style="font-size: 1.5rem">📋</span>
                    <span><strong>Управление доступом и аудит</strong> — принцип
                        минимальных привилегий, логирование действий.</span>
                </li>
            </ul>
        </div>

        <!-- Сравнение: до / после внедрения защиты -->
        <h2>📊 Эффективность на цифрах</h2>
        <div
            style="
          display: flex;
          flex-wrap: wrap;
          gap: 24px;
          justify-content: space-between;
          margin-bottom: 48px;
        ">
            <div
                style="
            flex: 1;
            background: #fef5e8;
            border-radius: 24px;
            padding: 20px;
            text-align: center;
          ">
                <div style="font-size: 2rem">⚠️</div>
                <div style="font-size: 1.6rem; font-weight: bold; color: #b03a2e">
                    -73%
                </div>
                <p>риска утечки данных при внедрении MFA</p>
            </div>
            <div
                style="
            flex: 1;
            background: #e8f0fe;
            border-radius: 24px;
            padding: 20px;
            text-align: center;
          ">
                <div style="font-size: 2rem">📉</div>
                <div style="font-size: 1.6rem; font-weight: bold; color: #1f618d">
                    до 80%
                </div>
                <p>фишинговых атак предотвращается обучением сотрудников</p>
            </div>
            <div
                style="
            flex: 1;
            background: #e9f7e1;
            border-radius: 24px;
            padding: 20px;
            text-align: center;
          ">
                <div style="font-size: 2rem">💾</div>
                <div style="font-size: 1.6rem; font-weight: bold; color: #2e6b2f">
                    99%
                </div>
                <p>восстановление данных при регулярных бэкапах</p>
            </div>
        </div>

        <!-- Блок с важным предупреждением / памяткой -->
        <div
            class="demo-scroll-notice"
            style="background: #1e2f2a; color: white; border-left-color: #f1c40f">
            <strong>📌 Памятка пользователю:</strong> Никогда не переходите по
            подозрительным ссылкам, не используйте один пароль везде, включайте
            автоматические обновления ПО. Регулярно проверяйте, какие устройства
            имеют доступ к вашим аккаунтам.
        </div>

        <!-- Дополнительный раздел: стандарты и комплаенс -->
        <h2>📜 Стандарты и регулирование</h2>
        <p>
            В разных странах действуют требования к защите данных. Наиболее
            известные:
        </p>
        <ul style="margin-bottom: 30px">
            <li>
                <strong>GDPR</strong> (ЕС) — права субъектов данных, уведомления об
                утечках.
            </li>
            <li>
                <strong>PCI DSS</strong> — стандарт безопасности для организаций,
                работающих с платежными картами.
            </li>
            <li>
                <strong>ISO/IEC 27001</strong> — международный стандарт систем
                менеджмента информационной безопасности.
            </li>
            <li>
                <strong>152-ФЗ / 187-ФЗ</strong> (РФ) — о персональных данных и
                безопасности КИИ.
            </li>
        </ul>

        <!-- Финальный призыв к действию (без обязательств) -->
        <div
            style="
          text-align: center;
          margin: 48px 0 30px;
          padding: 20px;
          border-top: 1px solid #cbdcd2;
        ">
            <p style="font-size: 1.1rem">
                🛡️ Информационная безопасность — это не продукт, а непрерывный
                процесс.<br />
                Начните с аудита своих рисков уже сегодня.
            </p>
        </div>
        <div>
            <?php include 'table.php'; ?>
        </div>
        <div>
            <?php include 'image.php'; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>