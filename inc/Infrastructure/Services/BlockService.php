<?php

namespace PluginName\Infrastructure\Services;

use WP_Block;

defined('ABSPATH') || exit;

class BlockService
{
	public function __construct()
	{
		add_action('init', [$this, 'registerBlockTypes']);
	}

	public function registerBlockTypes(): void
	{

		//First Block (or whatever your block name is)
		register_block_type(
			PLUGIN_NAME_PLUGIN_DIR_PATH . '/build/first-block'/*,
			[
				//Callback function for your block (optional, use this callback if you want to make server side rendering)
				'render_callback' => [$this, 'firstBlockRenderCallback']
			]*/
		);

	}

	public function firstBlockRenderCallback(array $block_attributes, string $content, WP_Block $block): string
	{
		$html = '<div ' . get_block_wrapper_attributes() . '>';
		if ($block_attributes['firstAttr']) {
			$html .= __("First Block: Hello from callback function / Attributes setted...");
		} else {
			$html .= __("First Block: Hello from callback function / Attributes not setted...");
		}
		$html .= '</div>';
		return $html;

	}
}
