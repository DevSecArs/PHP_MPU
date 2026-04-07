<?php
// Получаем текущую секунду
$current_second = date('s'); // от 00 до 59
$is_even = ($current_second % 2 == 0); // true если четная, false если нечетная

// Выбираем фотографию в зависимости от четности секунды
if ($is_even) {
    $image_file = './inf_bezop.png';  // Фото для четной секунды
    $image_alt = 'Фотография для четной секунды';
    $image_description = 'Четная секунда: ' . $current_second;
} else {
    $image_file = './complience.png';   // Фото для нечетной секунды
    $image_alt = 'Фотография для нечетной секунды';
    $image_description = 'Нечетная секунда: ' . $current_second;
}
?>

<div class="dynamic-photo">

    <div class="photo-container">
        <img src="<?php echo $image_file; ?>"
            alt="<?php echo $image_alt; ?>"
            class="dynamic-img">
    </div>
    <div class="photo-container">
        <img src="./ekspertiza.png"
            alt="Статичная"
            class="dynamic-img">
    </div>
</div>

<style>
    .dynamic-photo {
        max-width: 300px;
        /* max-height: 300px; */
        margin: 20px auto;
        padding: 20px;
        background: #f9fbf9;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        font-family: system-ui, 'Segoe UI', sans-serif;
    }

    .dynamic-photo h3 {
        color: #0a2f1f;
        margin-top: 0;
        margin-bottom: 10px;
    }

    .second-info {
        font-size: 1.1rem;
        margin-bottom: 20px;
        color: #2c3e32;
    }

    .second-info strong {
        color: #0a2f1f;
        font-size: 1.3rem;
    }

    .photo-container {
        margin: 20px 0;
    }

    .dynamic-img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 3px solid #0a2f1f;
        transition: transform 0.3s ease;
    }

    .dynamic-img:hover {
        transform: scale(1.02);
    }

    .photo-description {
        margin-top: 10px;
        font-size: 0.9rem;
        color: #5a6e62;
        font-style: italic;
    }

    .update-note {
        margin-top: 20px;
        font-size: 0.8rem;
        color: #7f8c8d;
        background: #eef2f0;
        padding: 8px;
        border-radius: 20px;
    }
</style>