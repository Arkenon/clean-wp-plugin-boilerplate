<?php

namespace PluginName\Infrastructure\Services;

defined('ABSPATH') || exit;

class AssetService
{
	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
	}

	public function enqueueScripts()
	{
		wp_enqueue_script('plugin-name-script', PLUGIN_NAME_PLUGIN_URL . 'assets/js/plugin-name.js', ['jquery'], PLUGIN_NAME_VERSION, true);
		wp_enqueue_style('plugin-name-style', PLUGIN_NAME_PLUGIN_URL . 'assets/css/plugin-name.css', [], PLUGIN_NAME_VERSION);
	}
}
