<?php
/**
 * Deactivation service class for the plugin
 * @package PluginName
 * @subpackage Infrastructure\Services
 * @since 1.0.0
 */

namespace PluginName\Infrastructure\Services;

defined('ABSPATH') || exit;

class ActivationService
{
	public function activate(): void
	{
		//Define custom activation hook
		do_action('plugin_name_activation');
	}
}
