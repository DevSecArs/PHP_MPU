<?php
// В начале файла задаём название страницы
$page_title = 'Контакты';
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
    <!-- Hero-секция -->
    <section style="text-align: center; margin-bottom: 48px">
      <h1
        style="
        font-size: 2.5rem;
        margin-bottom: 16px;
        border-left: none;
        text-align: center;
      ">
        📞 Контакты
      </h1>
      <p
        style="
        font-size: 1.2rem;
        color: #2c3e32;
        max-width: 800px;
        margin: 0 auto;
      ">
        Свяжитесь с нами любым удобным способом. Мы ответим в течение 24 часов.
      </p>
    </section>

    <!-- Два колонки: контактная информация + форма (опционально) -->
    <div style="display: flex; flex-wrap: wrap; gap: 32px; margin-bottom: 48px">
      <!-- Левая колонка: контакты -->
      <div style="flex: 1; min-width: 250px">
        <h2 style="margin-top: 0">📇 Реквизиты</h2>
        <ul style="list-style-type: none; padding-left: 0">
          <li
            style="
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
          ">
            <span style="font-size: 1.4rem">📍</span>
            <span><strong>Адрес:</strong> г. Москва, ул. Цифровая, д. 10, БЦ
              «Технопарк», офис 507</span>
          </li>
          <li
            style="
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
          ">
            <span style="font-size: 1.4rem">📞</span>
            <span><strong>Телефон:</strong>
              <a
                href="tel:+74951234567"
                style="color: #0a2f1f; text-decoration: none">+7 (495) 123-45-67</a></span>
          </li>
          <li
            style="
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
          ">
            <span style="font-size: 1.4rem">✉️</span>
            <span><strong>Email:</strong>
              <a
                href="mailto:info@securitycompany.ru"
                style="color: #0a2f1f; text-decoration: none">info@securitycompany.ru</a></span>
          </li>
          <li
            style="
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
          ">
            <span style="font-size: 1.4rem">🕒</span>
            <span><strong>Режим работы:</strong> Пн–Пт: 9:00–20:00, Сб:
              10:00–16:00</span>
          </li>
          <li
            style="
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
          ">
            <span style="font-size: 1.4rem">🌐</span>
            <span><strong>Техподдержка 24/7:</strong>
              support@securitycompany.ru</span>
          </li>
        </ul>
      </div>

      <!-- Правая колонка: схематичная карта / соцсети -->
      <div style="flex: 1; min-width: 250px">
        <h2 style="margin-top: 0">🌍 Социальные сети</h2>
        <div
          style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 32px">
          <a
            href="#"
            style="
            background: #0a2f1f;
            color: white;
            padding: 10px 20px;
            border-radius: 40px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
          ">📘 Facebook</a>
          <a
            href="#"
            style="
            background: #0a2f1f;
            color: white;
            padding: 10px 20px;
            border-radius: 40px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
          ">📸 Instagram</a>
          <a
            href="#"
            style="
            background: #0a2f1f;
            color: white;
            padding: 10px 20px;
            border-radius: 40px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
          ">💼 LinkedIn</a>
          <a
            href="#"
            style="
            background: #0a2f1f;
            color: white;
            padding: 10px 20px;
            border-radius: 40px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
          ">🐦 Twitter</a>
          <a
            href="#"
            style="
            background: #0a2f1f;
            color: white;
            padding: 10px 20px;
            border-radius: 40px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
          ">💬 Telegram</a>
        </div>

        <!-- Схема проезда (имитация карты) -->
        <h2>🗺️ Схема проезда</h2>
        <div
          style="
          background: #eef2f0;
          border-radius: 20px;
          padding: 20px;
          text-align: center;
          border: 1px dashed #0a2f1f;
        ">
          <div style="font-size: 3rem">🏢</div>
          <p style="margin: 8px 0 0">
            м. «Цифровая», 5 минут пешком. Вход со стороны ул. Технологическая.
          </p>
          <p style="font-size: 0.8rem; color: #5a6e62">
            Интерактивная карта доступна по запросу
          </p>
        </div>
      </div>
    </div>

    <!-- Форма обратной связи (простая) -->
    <h2>✍️ Напишите нам</h2>
    <div
      style="
      background: #ffffff;
      border-radius: 28px;
      padding: 28px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
      margin-bottom: 48px;
    ">
      <form
        action="#"
        method="post"
        style="display: flex; flex-direction: column; gap: 20px">
        <div style="display: flex; flex-wrap: wrap; gap: 20px">
          <input
            type="text"
            placeholder="Ваше имя"
            required
            style="
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #cbdcd2;
            border-radius: 40px;
            font-size: 1rem;
          " />
          <input
            type="email"
            placeholder="Email для ответа"
            required
            style="
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #cbdcd2;
            border-radius: 40px;
            font-size: 1rem;
          " />
        </div>
        <select
          style="
          padding: 12px 16px;
          border: 1px solid #cbdcd2;
          border-radius: 40px;
          font-size: 1rem;
          background: white;
        ">
          <option>Тема обращения</option>
          <option>Консультация по ИБ</option>
          <option>Аудит безопасности</option>
          <option>Техподдержка</option>
          <option>Сотрудничество</option>
          <option>Другое</option>
        </select>
        <textarea
          rows="5"
          placeholder="Сообщение..."
          style="
          padding: 12px 16px;
          border: 1px solid #cbdcd2;
          border-radius: 24px;
          font-size: 1rem;
          font-family: inherit;
        "></textarea>
        <button
          type="submit"
          style="
          background: #0a2f1f;
          color: white;
          padding: 12px 24px;
          border: none;
          border-radius: 40px;
          font-size: 1rem;
          cursor: pointer;
          width: fit-content;
        ">
          Отправить →
        </button>
      </form>
    </div>

    <!-- Блок с важной информацией -->
    <div
      class="demo-scroll-notice"
      style="background: #1e2f2a; color: white; border-left-color: #f1c40f">
      <strong>🛡️ Безопасность связи:</strong> Для конфиденциальных обращений
      используйте наш PGP-ключ (доступен по запросу) или защищённый чат в
      Telegram.
    </div>

    <!-- Реквизиты компании -->
    <div
      style="
      margin-top: 48px;
      padding: 20px;
      background: #f9fbf9;
      border-radius: 24px;
    ">
      <h3 style="margin-top: 0">🏢 Юридическая информация</h3>
      <p>
        <strong>ООО «Цифровая защита»</strong><br />
        ИНН 7701234567 / КПП 770101001<br />
        ОГРН 1187700012345<br />
        Юридический адрес: 105064, г. Москва, ул. Земляной Вал, д. 9
      </p>
    </div>
  </main>

  <?php include 'footer.php'; ?>
</body>

</html>