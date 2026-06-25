<?php

namespace AlingsasHero\Module;

use AlingsasHero\Helper\CacheBust;

/**
 * Class alingsashero
 * @package alingsashero\Module
 */
class alingsashero extends \Modularity\Module
{
	public $slug = 'alingsashero';
	public $supports = array();

	public function init()
	{
		$this->nameSingular = __("(A) Hero", 'modularity-alingsashero');
		$this->namePlural   = __("(A) Hero", 'modularity-alingsashero');
		$this->description  = __("An interactive hero component for Modularity", 'modularity-alingsashero');
	}

	/**
	 * Data array
	 * @return array $data
	 */
	public function data(): array
	{
		$data = array();

		$data = array_merge($data, (array) \Modularity\Helper\FormatObject::camelCase(
			get_fields($this->ID)
		));

		$data['search'] = __('Search', 'modularity-alingsashero');

		$count = isset($data['numberOfRecommendations']) ? max(0, min(7, (int) $data['numberOfRecommendations'])) : 0;
		$data['numberOfRecommendations'] = $count;
		$data['rekAiEnabled'] = false;
		$data['rekAiContainerId'] = '';

		if ($count > 0 && (bool) get_field('rekai_enable', 'options') && get_field('rekai_script_url', 'options')) {
			$data['rekAiEnabled'] = true;
			$data['rekAiContainerId'] = 'hero-rek-' . md5(uniqid((string) mt_rand(), true));
		}

		$excludeTree = isset($data['excludetree']) && is_array($data['excludetree']) ? $data['excludetree'] : [];
		$excludeTreeCustomLinks = isset($data['excludetreeCustomLinks']) && is_string($data['excludetreeCustomLinks']) ? $data['excludetreeCustomLinks'] : '';

		$data['rekAiExcludetree'] = $this->createExcludeTree($excludeTree, $excludeTreeCustomLinks);

		return $data;
	}

	/**
	 * Blade Template
	 * @return string
	 */
	public function template(): string
	{
		return "alingsashero.blade.php";
	}

	/**
	 * Style - Register & adding css
	 * @return void
	 */
	public function style()
	{
		wp_register_style(
			'modularity-alingsashero',
			ALINGAS_HERO_URL . '/dist/' . CacheBust::name('css/modularity-alingsashero.css'),
			null,
			'1.0.0'
		);

		wp_enqueue_style('modularity-alingsashero');
	}

	/**
	 * Script - Register & adding scripts
	 * @return void
	 */
	public function script()
	{
		// Uncomment to use JS
		/* wp_register_script(
			'modularity-alingsashero',
			ALINGAS_HERO_URL . '/dist/' . CacheBust::name('js/modularity-alingsashero.js'),
			null,
			'1.0.0'
		);

		wp_enqueue_script('modularity-alingsashero'); */
	}

	public function createExcludeTree(array $excludeTree, string $excludeTreeCustomLinks): string
	{
		$tree = [];

		foreach ($excludeTree as $postId) {
			$permalink = str_replace(home_url(), '', get_permalink($postId));
			if ($permalink) {
				$tree[] = $permalink;
			}
		}

		$excludeTreeCustomLinks = str_replace(["\r\n", "\r"], "\n", $excludeTreeCustomLinks);
		$excludeTreeCustomLinks = array_map('trim', explode("\n", $excludeTreeCustomLinks));
		foreach ($excludeTreeCustomLinks as $link) {
			if (!empty($link)) {
				$permalink = str_replace(home_url(), '', esc_url($link));
				if ($permalink) {
					$tree[] = $permalink;
				}
			}
		}

		return implode(',', $tree);
	}

	/**
	 * Convert an array of post objects to a comma-separated string of permalinks.
	 * Remove domain from the permalinks to avoid CORS issues with RekAI when using absolute URLs.
	 *
	 * @param array $posts Array of WP_Post objects
	 * @return string Comma-separated post permalinks
	 */
	public function convertPostsToString(array $posts): string
	{
		return implode(',', array_map(fn($post) => str_replace(home_url(), '', get_permalink($post)), $posts));
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
