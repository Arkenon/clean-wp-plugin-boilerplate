<?php

namespace PluginName\Infrastructure\Services;

defined('ABSPATH') || exit;

class DeactivationService
{

	public function deactivate(): void
	{
		//Define custom deactivation hook
		do_action('plugin_name_deactivation');
	}

}
