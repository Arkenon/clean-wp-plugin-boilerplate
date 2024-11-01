<?php
/**
 * Email value object
 * Check if email is valid
 * @package PluginName
 * @subpackage Domain\ValueObjects
 */

namespace PluginName\Domain\ValueObjects;

defined( 'ABSPATH' ) || exit;

class Email {
	/**
	 * Check if email is valid
	 *
	 * @param string $email
	 *
	 * @return bool|string
	 * @since 1.0.0
	 */
	public static function isEmail( string $email ) {
		return is_email( $email );
	}
}
