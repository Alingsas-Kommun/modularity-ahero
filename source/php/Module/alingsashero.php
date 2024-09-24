<?php

namespace AlingsasComponents\Module;

use AlingsasComponents\Helper\CacheBust;

/**
 * Class alingsashero
 * @package alingsashero\Module
 */
class alingsashero extends \Modularity\Module {
	public $slug = 'alingsashero';
	public $supports = array();

	public function init() {
		$this->nameSingular = __( "(A) Hero", 'modularity-alingsashero' );
		$this->namePlural   = __( "(A) Hero", 'modularity-alingsashero' );
		$this->description  = __( "An interactive hero component for Modularity", 'modularity-alingsashero' );
	}

	/**
	 * Data array
	 * @return array $data
	 */
	public function data() : array {
		$data = array();

		$data = array_merge( $data, (array) \Modularity\Helper\FormatObject::camelCase(
			get_fields( $this->ID )
		) );
		return $data;
	}

	/**
	 * Blade Template
	 * @return string
	 */
	public function template() : string {
		return "alingsashero.blade.php";
	}

	/**
	 * Style - Register & adding css
	 * @return void
	 */
	public function style() {
		wp_register_style(
			'modularity-alingsashero',
			ALINGAS_COMPONENTS_URL . '/dist/' . CacheBust::name( 'css/modularity-alingsashero.css' ),
			null,
			'1.0.0'
		);

		wp_enqueue_style( 'modularity-alingsashero' );
	}

	/**
	 * Script - Register & adding scripts
	 * @return void
	 */
	public function script() {
		wp_register_script(
			'modularity-alingsashero',
			ALINGAS_COMPONENTS_URL . '/dist/' . CacheBust::name( 'js/modularity-alingsashero.js' ),
			null,
			'1.0.0'
		);

		wp_enqueue_script( 'modularity-alingsashero' );
	}

	/**
	 * Available "magic" methods for modules:
	 * init()            What to do on initialization
	 * data()            Use to send data to view (return array)
	 * style()           Enqueue style only when module is used on page
	 * script            Enqueue script only when module is used on page
	 * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
	 * template()        Return the view template (blade) the module should use when displayed
	 */
}
