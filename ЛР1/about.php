<?php
// В начале файла задаём название страницы
$page_title = 'О нас';
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
        📖 О нас
      </h1>
      <p
        style="
        font-size: 1.2rem;
        color: #2c3e32;
        max-width: 800px;
        margin: 0 auto;
      ">
        Мы создаём безопасное цифровое пространство с 2018 года. Надёжность,
        экспертиза и доверие — наши главные принципы.
      </p>
      <div class="badge" style="margin-top: 16px">7+ лет на рынке</div>
    </section>

    <!-- Миссия и ценности -->
    <div class="card-grid" style="margin-bottom: 48px">
      <div class="card">
        <h3>🎯 Миссия</h3>
        <p>
          Сделать кибербезопасность доступной и понятной для каждого бизнеса.
          Защищать то, что ценно — данные, репутацию, будущее.
        </p>
      </div>
      <div class="card">
        <h3>⭐ Ценности</h3>
        <p>
          Честность, непрерывное обучение, проактивный подход. Мы не ждём угроз —
          мы их предвосхищаем.
        </p>
      </div>
      <div class="card">
        <h3>🌍 Видение</h3>
        <p>
          Мир, где информационная безопасность — не барьер, а фундамент для роста
          и инноваций.
        </p>
      </div>
    </div>

    <!-- Наша история (таймлайн) -->
    <h2>📅 История развития</h2>
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
          margin-bottom: 20px;
          display: flex;
          align-items: flex-start;
          gap: 12px;
        ">
          <span style="font-size: 1.5rem; min-width: 40px">🏁</span>
          <span><strong>2018</strong> — Основание компании. Первые проекты по аудиту
            безопасности для中小 бизнеса.</span>
        </li>
        <li
          style="
          margin-bottom: 20px;
          display: flex;
          align-items: flex-start;
          gap: 12px;
        ">
          <span style="font-size: 1.5rem; min-width: 40px">🚀</span>
          <span><strong>2020</strong> — Запуск собтивного SOC (Security Operation
            Center) 24/7.</span>
        </li>
        <li
          style="
          margin-bottom: 20px;
          display: flex;
          align-items: flex-start;
          gap: 12px;
        ">
          <span style="font-size: 1.5rem; min-width: 40px">🌐</span>
          <span><strong>2022</strong> — Выход на международный рынок, сертификация по
            ISO 27001.</span>
        </li>
        <li
          style="
          margin-bottom: 20px;
          display: flex;
          align-items: flex-start;
          gap: 12px;
        ">
          <span style="font-size: 1.5rem; min-width: 40px">🤖</span>
          <span><strong>2024</strong> — Внедрение AI-решений для обнаружения аномалий
            в реальном времени.</span>
        </li>
        <li
          style="
          margin-bottom: 20px;
          display: flex;
          align-items: flex-start;
          gap: 12px;
        ">
          <span style="font-size: 1.5rem; min-width: 40px">🎯</span>
          <span><strong>2026</strong> — Более 500 успешных проектов и 98% клиентов
            продлевают сотрудничество.</span>
        </li>
      </ul>
    </div>

    <!-- Команда -->
    <h2>👥 Наша команда</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 24px; margin-bottom: 48px">
      <div
        style="
        flex: 1;
        min-width: 200px;
        text-align: center;
        background: #f9fbf9;
        border-radius: 24px;
        padding: 20px;
      ">
        <div style="font-size: 3rem">👩‍💻</div>
        <strong>Анна Воронцова</strong><br />
        <span style="font-size: 0.85rem; color: #5a6e62">CEO, эксперт по ИБ</span>
      </div>
      <div
        style="
        flex: 1;
        min-width: 200px;
        text-align: center;
        background: #f9fbf9;
        border-radius: 24px;
        padding: 20px;
      ">
        <div style="font-size: 3rem">🧑‍🔬</div>
        <strong>Дмитрий Лебедев</strong><br />
        <span style="font-size: 0.85rem; color: #5a6e62">Технический директор</span>
      </div>
      <div
        style="
        flex: 1;
        min-width: 200px;
        text-align: center;
        background: #f9fbf9;
        border-radius: 24px;
        padding: 20px;
      ">
        <div style="font-size: 3rem">👨‍🏫</div>
        <strong>Елена Морозова</strong><br />
        <span style="font-size: 0.85rem; color: #5a6e62">Руководитель отдела аудита</span>
      </div>
      <div
        style="
        flex: 1;
        min-width: 200px;
        text-align: center;
        background: #f9fbf9;
        border-radius: 24px;
        padding: 20px;
      ">
        <div style="font-size: 3rem">🛡️</div>
        <strong>Игорь Соколов</strong><br />
        <span style="font-size: 0.85rem; color: #5a6e62">Глава SOC</span>
      </div>
    </div>

    <!-- Достижения и сертификаты -->
    <h2>🏆 Сертификаты и награды</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 48px">
      <span class="badge" style="background: #0a2f1f; color: white">ISO/IEC 27001:2022</span>
      <span class="badge" style="background: #0a2f1f; color: white">PCI DSS Level 1</span>
      <span class="badge" style="background: #0a2f1f; color: white">GDPR Certified</span>
      <span class="badge" style="background: #0a2f1f; color: white">Лауреат «Digital Security Awards 2024»</span>
      <span class="badge" style="background: #0a2f1f; color: white">Топ-10 ИБ-компаний России (2025)</span>
    </div>

    <!-- Цитата / отзыв -->
    <div
      class="demo-scroll-notice"
      style="background: #1e2f2a; color: white; border-left-color: #f1c40f">
      <strong>💬 Клиенты о нас:</strong> «Профессионализм и оперативность. За три
      года сотрудничества — ни одной утечки, а все рекомендации действительно
      работают. Рекомендуем!» — Александр К., IT-директор крупного ритейлера.
    </div>

    <!-- Статистика -->
    <div
      style="
      display: flex;
      flex-wrap: wrap;
      gap: 24px;
      justify-content: space-between;
      margin: 48px 0 30px;
    ">
      <div style="flex: 1; text-align: center; padding: 20px">
        <div style="font-size: 2rem; font-weight: bold; color: #0a2f1f">500+</div>
        <div>проектов</div>
      </div>
      <div style="flex: 1; text-align: center; padding: 20px">
        <div style="font-size: 2rem; font-weight: bold; color: #0a2f1f">98%</div>
        <div>лояльности клиентов</div>
      </div>
      <div style="flex: 1; text-align: center; padding: 20px">
        <div style="font-size: 2rem; font-weight: bold; color: #0a2f1f">24/7</div>
        <div>поддержка SOC</div>
      </div>
      <div style="flex: 1; text-align: center; padding: 20px">
        <div style="font-size: 2rem; font-weight: bold; color: #0a2f1f">10+</div>
        <div>стран-клиентов</div>
      </div>
    </div>
  </main>


  <?php include 'footer.php'; ?>
</body>

</html>