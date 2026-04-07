<?php
// Определяем текущую страницу из URL параметра 'page'
$current_page = isset($_GET['page']) ? $_GET['page'] : 'main';
?>

<nav class="main-navigation">
    <div class="nav-container">
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="<?php echo './index.php'; ?>" class="nav-link <?php echo ($page_title == 'Главная страница') ? 'active' : ''; ?>">
                    🏠 Главная
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo './about.php'; ?>" class="nav-link <?php echo ($page_title == 'О нас') ? 'active' : ''; ?>">
                    📖 О нас
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo './contacts.php'; ?>" class="nav-link <?php echo ($page_title == 'Контакты') ? 'active' : ''; ?>">
                    📞 Контакты
                </a>
            </li>
        </ul>
    </div>
</nav>

<style>
    /* Стили для навигации */
    .main-navigation {
        background-color: #0a2f1f;
        /* Тёмно-зелёный, как у футера */
        padding: 0;
        margin: 0;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .nav-menu {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 32px;
        align-items: center;
    }

    .nav-item {
        margin: 0;
    }

    .nav-link {
        display: inline-block;
        padding: 20px 8px;
        color: white;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    /* Подсветка активной страницы */
    .nav-link.active {
        color: #ffd700;
        /* Золотистый цвет для активной ссылки */
        font-weight: 600;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 12px;
        left: 8px;
        right: 8px;
        height: 2px;
        background-color: #ffd700;
        border-radius: 2px;
    }

    /* Эффект при наведении */
    .nav-link:hover {
        color: #ffd700;
        opacity: 0.9;
    }

    /* Адаптивность для мобильных устройств */
    @media (max-width: 768px) {
        .nav-menu {
            gap: 16px;
            justify-content: center;
        }

        .nav-link {
            padding: 15px 6px;
            font-size: 0.9rem;
        }

        .nav-link.active::after {
            bottom: 8px;
        }
    }

    @media (max-width: 480px) {
        .nav-menu {
            gap: 12px;
        }

        .nav-link {
            padding: 12px 4px;
            font-size: 0.85rem;
        }
    }
</style>