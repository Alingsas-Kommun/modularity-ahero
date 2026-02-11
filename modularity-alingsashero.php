<?php

/**
 * Plugin Name:       Alingsas Hero
 * Plugin URI:        https://github.com/Alingsas-Kommun/modularity-ahero
 * Description:       An interactive hero component for Modularity
 * Version:           1.3.0
 * Author:            Consid Borås AB, Alingsås kommun
 * Author URI:        https://github.com/Alingsas-Kommun
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       modularity-alingsashero
 * Domain Path:       /languages
 */

// Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('ALINGAS_HERO_PATH', plugin_dir_path(__FILE__));
define('ALINGAS_HERO_URL', plugins_url('', __FILE__));
define('ALINGAS_HERO_TEMPLATE_PATH', ALINGAS_HERO_PATH . 'templates/');
define('ALINGAS_HERO_VIEW_PATH', ALINGAS_HERO_PATH . 'views/');
define('ALINGAS_HERO_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('ALINGAS_HERO_MODULE_PATH', ALINGAS_HERO_PATH . 'source/php/Module/');

add_action('init', function () {
    load_plugin_textdomain('modularity-alingsashero', false, plugin_basename(dirname(__FILE__)) . '/languages');
});

require_once ALINGAS_HERO_PATH . 'vendor/autoload.php';

require_once ALINGAS_HERO_PATH . 'Public.php';

// Acf auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('modularity-alingsashero');
    $acfExportManager->setExportFolder(ALINGAS_HERO_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'module' => 'group_66f17c34c585e',
    ));
    $acfExportManager->import();
});

// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-alingsashero'] = ALINGAS_HERO_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new AlingsasHero\App();
