<?php
/**
 * Mapper class
 * This class is responsible for mapping objects to other objects, arrays, etc.
 * Supports generic types
 * @package PluginName
 * @subpackage PluginName\Common\Tools
 */

namespace PluginName\Common\Tools;

use ReflectionClass;
use ReflectionException;

class Mapper {

	/**
	 * Maps an object to another object
	 *
	 * @template TModel (for generic type)
	 *
	 * @param object $source The source object to map from
	 * @param class-string<TModel> $destination The destination class or object
	 *
	 * @psalm-return TModel
	 * @return object
	 * @throws ReflectionException
	 */
	public function mapObjectToObject( object $source, string $destination ): object {
		$sourceReflection      = ( new Mapper() )->getReflectionClass( $source );
		$destinationReflection = ( new Mapper() )->getReflectionClass( $destination );

		$sourceInstance      = ( new Mapper() )->getInstance( $source );
		$destinationInstance = ( new Mapper() )->getInstance( $destination );

		foreach ( $sourceReflection->getProperties() as $sourceProperty ) {
			$sourceProperty->setAccessible( true );
			$propertyName = $sourceProperty->getName();

			if ( $destinationReflection->hasProperty( $propertyName ) ) {
				$destinationProperty = $destinationReflection->getProperty( $propertyName );
				$destinationProperty->setAccessible( true );
				$destinationProperty->setValue( $destinationInstance, $sourceProperty->getValue( $sourceInstance ) );
			}
		}

		return $destinationInstance;
	}

	/**
	 * Maps an object to an array
	 *
	 * @param object $source
	 *
	 * @return array
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function mapObjectToArray( object $source ): array {
		if ( ! is_object( $source ) ) {
			return [];
		}

		$result     = [];
		$reflection = $this->getReflectionClass( $source );
		$instance   = $this->getInstance( $source );

		foreach ( $reflection->getProperties() as $property ) {
			$property->setAccessible( true );
			if ( $property->getName() !== null ) {
				$result[ $property->getName() ] = $property->getValue( $instance );
			}
		}

		return $result;
	}

	/**
	 * Maps an array to an object
	 *
	 * @template TModel (for generic type)
	 *
	 * @param array $source The source array to map from
	 * @param class-string<TModel> $destination The destination class or object
	 *
	 * @psalm-return TModel
	 * @return object
	 * @throws ReflectionException
	 */
	public function mapArrayToObject( array $source, string $destination ): object {
		$reflection = ( new Mapper() )->getReflectionClass( $destination );
		$instance   = ( new Mapper() )->getInstance( $destination );

		foreach ( $source as $key => $value ) {
			if ( $reflection->hasProperty( $key ) ) {
				$property = $reflection->getProperty( $key );
				$property->setAccessible( true );
				$property->setValue( $instance, $value );
			}
		}

		return $instance;
	}

	/**
	 * Maps an array to another array
	 *
	 * @param array $source The source array to map from
	 * @param array $destination The destination array
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function mapArrayToArray( array $destination, array $source ): array {
		return wp_parse_args( $destination, $source );
	}

	/**
	 * Returns an instance of ReflectionClass
	 *
	 * @param string|object $class
	 *
	 * @return ReflectionClass
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	private function getReflectionClass( $class ): ReflectionClass {
		return is_object( $class ) ? new ReflectionClass( get_class( $class ) ) : new ReflectionClass( $class );
	}

	/**
	 * Returns an instance of the class
	 *
	 * @param string|object $class
	 *
	 * @return object
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	private function getInstance( $class ): object {
		if ( is_object( $class ) ) {
			return $class;
		}

		$reflection = $this->getReflectionClass( $class );
		if ( $reflection->isInstantiable() ) {
			return $reflection->newInstanceWithoutConstructor();
		}

		throw new ReflectionException(
			sprintf(
			/* Translators: %s is the class name */
				esc_html__( "Cannot create an instance of %s%", 'plugin-name' ),
				esc_html( $class ) )
		);
	}
}
