<?php

namespace AlingsasComponents\Admin;

class Settings
{
    public function __construct() {
        //add_action('acf/init', array($this, 'registerSettings'));
    }

    /**
     * Register settings
     * @return void
     */
    public function registerSettings()
    {
        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page(array(
                'page_title'  => __("Alingsas Hero", 'modularity-alingsashero'),
                'menu_title'  => __("Alingsas Hero Settings", 'modularity-alingsashero'),
                'menu_slug'   => 'modularity-alingsashero-settings',
                'parent_slug' => 'options-general.php',
                'capability'  => 'manage_options'
            ));
        }
    }
}
