<?php

namespace PluginName\Infrastructure\Services;

defined('ABSPATH') || exit;

class i18nService
{

	public function __construct()
	{

		load_plugin_textdomain(
			"plugin-name",
			false,
			PLUGIN_NAME_PLUGIN_DIR_PATH . 'languages/'
		);

	}

}
