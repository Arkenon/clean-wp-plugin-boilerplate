<?php

namespace PluginName\Common\Helpers;

defined( 'ABSPATH' ) || exit;

class Helper {

	/**
	 * Sanitize input
	 *
	 * @param string $name Input name
	 * @param string $method GET or POST
	 * @param string $type Type of input (title, id, textarea, url, email, username, text, bool)
	 *
	 * @return array|bool|int|string|null
	 *
	 * @since 1.0.0
	 */
	public static function sanitize( string $name, string $method, string $type = '' ) {
		$input = strtolower( $method ) === 'post' ? $_POST : $_GET;

		if ( ! isset( $input[ $name ] ) ) {
			return null;
		}

		$value = $input[ $name ];

		if ( is_array( $value ) ) {
			return self::sanitizeArray( $value );
		}

		$value = sanitize_text_field( $value );

		switch ( $type ) {
			case "title":
				return sanitize_title( $value );
			case "id":
				return absint( $value );
			case "textarea":
				return sanitize_textarea_field( $value );
			case "url":
				return esc_url_raw( $value );
			case "email":
				return sanitize_email( $value );
			case "username":
				return sanitize_user( $value );
			case "text":
				return $value; // Already sanitized, but for consistency
			case "bool":
				return rest_sanitize_boolean( $value );
			default:
				return $value;
		}
	}

	/**
	 * Sanitize array recursively
	 *
	 * @param array $array
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public static function sanitizeArray( array $array ): array {
		return array_map( function ( $value ) {
			if ( is_array( $value ) ) {
				return $this->sanitizeArray( $value );
			}

			return sanitize_text_field( $value );
		}, array_combine(
			array_map( 'sanitize_text_field', array_keys( $array ) ),
			$array
		) );
	}


}
