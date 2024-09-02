<?php

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
