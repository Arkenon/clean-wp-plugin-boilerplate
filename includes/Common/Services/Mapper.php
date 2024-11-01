<?php
/**
 * Mapper class
 * This class is responsible for mapping objects to other objects, arrays, etc.
 * @package PluginName
 * @subpackage PluginName\Common\Services
 */

namespace PluginName\Common\Services;

use ReflectionClass;
use ReflectionException;

class Mapper {

	/**
	 * Maps an object to another object
	 *
	 * @param $source
	 * @param $destination
	 *
	 * @return object
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function mapObjectToObject( $source, $destination ): object {
		$sourceReflection      = ( new Mapper )->getReflectionClass( $source );
		$destinationReflection = ( new Mapper )->getReflectionClass( $destination );

		$sourceInstance      = ( new Mapper )->getInstance( $source );
		$destinationInstance = ( new Mapper )->getInstance( $destination );

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
	 * @param $source
	 *
	 * @return array
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function mapObjectToArray( $source ): array {
		if ( ! is_object( $source ) ) {
			return [];
		}

		$result     = [];
		$reflection = $this->getReflectionClass( $source );
		$instance   = $this->getInstance( $source );

		foreach ( $reflection->getProperties() as $property ) {
			$property->setAccessible( true );
			$result[ $property->getName() ] = $property->getValue( $instance );
		}

		return $result;
	}

	/**
	 * Maps an array to an object
	 *
	 * @param array $source
	 * @param $destination
	 *
	 * @return object
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function mapArrayToObject( array $source, $destination ): object {
		$reflection = ( new Mapper )->getReflectionClass( $destination );
		$instance   = ( new Mapper )->getInstance( $destination );

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
	 * Returns an instance of ReflectionClass
	 *
	 * @param $class
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
	 * @param $class
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
