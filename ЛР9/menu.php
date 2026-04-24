<?php
function getMenu($active_menu)
{
    $sort_type = isset($_GET['sort']) ? $_GET['sort'] : 'id';

    $menu = '<div class="menu-container">';

    // Основное меню
    $menu .= '<div class="main-menu">';

    $menu_items = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];

    foreach ($menu_items as $key => $label) {
        $active_class = ($active_menu == $key) ? ' active' : '';
        $url = "?menu=" . $key;

        // Сохраняем параметры сортировки для меню просмотра
        if ($key == 'view' && $active_menu == 'view' && $sort_type != 'id') {
            $url .= "&sort=" . $sort_type;
        }

        $menu .= '<a href="' . $url . '" class="menu-btn' . $active_class . '">' . $label . '</a>';
    }

    $menu .= '</div>';

    // Дополнительное меню для сортировки (только при активном "Просмотр")
    if ($active_menu == 'view') {
        $menu .= '<div class="sub-menu">';

        $sort_items = [
            'id' => 'По порядку',
            'lastname' => 'По фамилии',
            'birthdate' => 'По дате рождения'
        ];

        foreach ($sort_items as $key => $label) {
            $active_class = ($sort_type == $key) ? ' active' : '';
            $menu .= '<a href="?menu=view&sort=' . $key . '" class="sub-menu-btn' . $active_class . '">' . $label . '</a>';
        }

        $menu .= '</div>';
    }

    $menu .= '</div>';

    return $menu;
}
