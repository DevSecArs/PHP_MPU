<?php
// Подключение к базе данных PostgreSQL
$host = 'localhost';
$dbname = 'contacts_db';
$username = 'postgres';  // или ваш пользователь PostgreSQL
$password = 'postgres';  // ваш пароль

try {
  $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Ошибка подключения к БД: " . $e->getMessage());
}

// Определение активного пункта меню
$menu_active = isset($_GET['menu']) ? $_GET['menu'] : 'view';

// Подключение модуля меню
require_once 'menu.php';

// Определение контента
$content = '';

switch ($menu_active) {
  case 'view':
    require_once 'viewer.php';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $content = getViewContent($pdo, $sort, $page);
    break;

  case 'add':
    require_once 'add.php';
    $content = getAddContent($pdo);
    break;

  case 'edit':
    require_once 'edit.php';
    $content = getEditContent($pdo);
    break;

  case 'delete':
    require_once 'delete.php';
    $content = getDeleteContent($pdo);
    break;

  default:
    require_once 'viewer.php';
    $content = getViewContent($pdo, 'id', 1);
}
?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Агаев Арслан 241-353 ЛР-9 Вариант 1</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Дополнительные стили для меню */
    .menu-container {
      background: #f8f9fa;
      padding: 15px;
      margin-bottom: 20px;
      border-bottom: 2px solid #dee2e6;
    }

    .main-menu {
      display: flex;
      gap: 10px;
      margin-bottom: 10px;
      flex-wrap: wrap;
    }

    .menu-btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .menu-btn:hover {
      background-color: #0056b3;
    }

    .menu-btn.active {
      background-color: #dc3545;
    }

    .sub-menu {
      display: flex;
      gap: 8px;
      margin-top: 8px;
    }

    .sub-menu-btn {
      display: inline-block;
      padding: 6px 12px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 4px;
      font-size: 0.85em;
    }

    .sub-menu-btn:hover {
      background-color: #0056b3;
    }

    .sub-menu-btn.active {
      background-color: #dc3545;
    }

    .pagination {
      display: flex;
      justify-content: center;
      gap: 8px;
      margin-top: 20px;
    }

    .pagination a {
      padding: 8px 12px;
      border: 1px solid #007bff;
      color: #007bff;
      text-decoration: none;
      border-radius: 4px;
    }

    .pagination a:hover {
      border: 2px solid #007bff;
    }

    .pagination a.active {
      background-color: #007bff;
      color: white;
    }

    .success-message {
      color: #28a745;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #28a745;
      border-radius: 4px;
      background-color: #d4edda;
    }

    .error-message {
      color: #dc3545;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #dc3545;
      border-radius: 4px;
      background-color: #f8d7da;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #dee2e6;
    }

    th {
      background-color: #f8f9fa;
      font-weight: bold;
      color: #495057;
    }

    tr:hover {
      background-color: #f8f9fa;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #495057;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 50%;
      padding: 8px;
      border: 1px solid #ced4da;
      border-radius: 4px;
      font-size: 1em;
    }

    .form-group textarea {
      height: 100px;
      resize: vertical;
    }

    .submit-btn {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1em;
      font-weight: bold;
    }

    .submit-btn:hover {
      background-color: #0056b3;
    }

    .contact-list {
      list-style: none;
      padding: 0;
      margin: 20px 0;
    }

    .contact-list li {
      margin-bottom: 8px;
    }

    .contact-list a {
      padding: 8px 12px;
      background-color: #f8f9fa;
      border: 1px solid #dee2e6;
      border-radius: 4px;
      display: block;
      color: #495057;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .contact-list a:hover {
      background-color: #e9ecef;
    }

    .contact-list a.current {
      background-color: #007bff;
      color: white;
      border-color: #0056b3;
    }
  </style>
</head>

<body>
  <header>
    <img src="./logo.png" alt="" width="90">
    <span>Агаев Арслан 241-353 ЛР-9 Вариант 1</span>
  </header>

  <main>
    <?php echo getMenu($menu_active); ?>
    <?php echo $content; ?>
  </main>

  <footer>@copyright 2026</footer>
</body>

</html>