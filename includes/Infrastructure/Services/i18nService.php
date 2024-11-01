<?php
/**
 * i18n service class for plugin
 * @package PluginName
 * @subpackage Infrastructure\Services
 * @since 1.0.0
 */

namespace PluginName\Infrastructure\Services;

use PluginName\Persistence\Constants\Constants;

defined( 'ABSPATH' ) || exit;

class i18nService {
	public function __construct() {
		// Load plugin text domain for translation
		load_plugin_textdomain(
			Constants::NAME,
			false,
			PLUGIN_NAME_PATH . 'languages/'
		);
	}
}
