<?php

/**
 * Plugin Name:       Alingsas Hero
 * Plugin URI:        https://github.com/v7ltz/modularity-alingsashero
 * Description:       An interactive hero component for Modularity
 * Version:           0.1.5
 * Author:            Consid
 * Author URI:        https://github.com/v7ltz
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       mod-alingsashero
 * Domain Path:       /languages
 */

// Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('ALINGAS_COMPONENTS_PATH', plugin_dir_path(__FILE__));
define('ALINGAS_COMPONENTS_URL', plugins_url('', __FILE__));
define('ALINGAS_COMPONENTS_TEMPLATE_PATH', ALINGAS_COMPONENTS_PATH . 'templates/');
define('ALINGAS_COMPONENTS_VIEW_PATH', ALINGAS_COMPONENTS_PATH . 'views/');
define('ALINGAS_COMPONENTS_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('ALINGAS_COMPONENTS_MODULE_PATH', ALINGAS_COMPONENTS_PATH . 'source/php/Module/');

load_plugin_textdomain('modularity-alingsashero', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once ALINGAS_COMPONENTS_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once ALINGAS_COMPONENTS_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new AlingsasComponents\Vendor\Psr4ClassLoader();
$loader->addPrefix('AlingsasComponents', ALINGAS_COMPONENTS_PATH);
$loader->addPrefix('AlingsasComponents', ALINGAS_COMPONENTS_PATH . 'source/php/');
$loader->register();

// Acf auto import and export
$acfExportManager = new \AcfExportManager\AcfExportManager();
$acfExportManager->setTextdomain('modularity-alingsashero');
$acfExportManager->setExportFolder(ALINGAS_COMPONENTS_PATH . 'source/php/AcfFields/');
$acfExportManager->autoExport(array(
    'module' => 'group_66f17c34c585e',
));
$acfExportManager->import();

// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-alingsashero'] = ALINGAS_COMPONENTS_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new AlingsasComponents\App();
