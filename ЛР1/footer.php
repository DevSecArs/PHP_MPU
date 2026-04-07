<?php
date_default_timezone_set('Europe/Moscow');
$current_datetime = date('d.m.Y H:i:s');
$day_of_week = [
    'Monday' => 'Понедельник',
    'Tuesday' => 'Вторник',
    'Wednesday' => 'Среда',
    'Thursday' => 'Четверг',
    'Friday' => 'Пятница',
    'Saturday' => 'Суббота',
    'Sunday' => 'Воскресенье'
][date('l')];
?>

<div class="top-footer">
    <div class="footer-brand">
        <span>🌿</span>
        <span>VerdantBase</span>
    </div>


    <div class="footer-right">
        <div class="time-display">
            Сформированно
            📅 <?php echo date('d.m.Y'); ?> |
            ⏰ <?php echo date('H:i:s'); ?> |
            📆 <?php echo $day_of_week; ?>
        </div>
        <div class="social-icon">🐦</div>
        <div class="social-icon">📷</div>
        <div class="social-icon">💻</div>
        <span class="text-copyright">© 2026</span>
    </div>
</div>


<style>
    /* Те же стили, что выше */
    .top-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 70px;
        background-color: #0a2f1f;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 32px;
        z-index: 1000;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .footer-brand {
        font-weight: 600;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .footer-right {
        display: flex;
        gap: 20px;
        align-items: center;
        font-size: 0.9rem;
    }

    .time-display {
        background: rgba(255, 255, 255, 0.12);
        padding: 6px 12px;
        border-radius: 40px;
        font-size: 0.85rem;
        font-family: monospace;
    }

    .social-icon {
        background: rgba(255, 255, 255, 0.15);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>