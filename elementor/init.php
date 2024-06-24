<?php
function add_elementor_widget_categories($elements_manager)
{
    $elements_manager->add_category(
        'cm-category',
        [
            'title' => esc_html__('tcc', 'tcc-theme'),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories', 1);

function cm_register_elementor_widgets($widgets_manager)
{
    // auto import all files in widgets folder
    $template_directory  = get_stylesheet_directory() . '/elementor';
    $folders = ['widgets'];
    foreach ($folders as $key => $folder) {
        $files = deep_scan($template_directory . '/' . $folder, []);
        if (!empty($files)) {
            foreach ($files as $file) {
                require($file);
                $_class = str_replace('.php', '', basename($file));
                if (class_exists($_class)) {
                    $widgets_manager->register(new $_class());
                }
            }
        }
    }
}
add_action('elementor/widgets/register', 'cm_register_elementor_widgets');
