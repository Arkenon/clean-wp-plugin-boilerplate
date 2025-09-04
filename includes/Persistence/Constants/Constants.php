<?php
/**
 * Additional Plugin Constants
 * (Base constant defined in the main plugin php file)
 * @package PluginName
 * @subpackage Persistence\Constants
 * @since 1.0.0
 */

namespace PluginName\Persistence\Constants;

defined( 'ABSPATH' ) || exit;

class Constants {
	public const NAME = 'plugin_name';
	public const INCLUDES_PATH = PLUGIN_NAME_PATH . 'includes/';
	public const INCLUDES_URL = PLUGIN_NAME_URL . '/includes/';
	public const AUTHOR = 'Kadim Gültekin';
	public const AUTHOR_URL = 'https://kadimgultekin.com/';
	public const PLUGIN_URL = 'https://kadimgultekin.com/';
	public const EMAIL = 'info@kadimgultekin.com';
	public const PHP_VERSION = '7.4';
	public const WP_VERSION = '6.1';
}
