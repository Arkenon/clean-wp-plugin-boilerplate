<?php

namespace PluginName\Domain\ValueObjects;

defined( 'ABSPATH' ) || exit;

class Email {
	/**
	 * @param string $email
	 *
	 * @return bool|string
	 */
	public static function get( string $email ) {
		return is_email( $email );
	}
}
