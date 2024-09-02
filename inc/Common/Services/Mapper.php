<?php

namespace PluginName\Common\Services;

use ReflectionClass;
use ReflectionException;

class Mapper {

	/**
	 * @throws ReflectionException
	 */
	public function mapObjectToObject( $source, $destination ) {
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
	 * @throws ReflectionException
	 */
	public function mapObjectToArray( $source ): array {
		$result     = [];
		$reflection = ( new Mapper )->getReflectionClass( $source );
		$instance   = ( new Mapper )->getInstance( $source );

		foreach ( $reflection->getProperties() as $property ) {
			$property->setAccessible( true );
			$result[ $property->getName() ] = $property->getValue( $instance );
		}

		return $result;
	}

	/**
	 * @throws ReflectionException
	 */
	public function mapArrayToObject( array $source, $destination ) {
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
	 * @throws ReflectionException
	 */
	private function getReflectionClass( $class ): ReflectionClass {
		return is_object( $class ) ? new ReflectionClass( get_class( $class ) ) : new ReflectionClass( $class );
	}

	/**
	 * @throws ReflectionException
	 */
	private function getInstance( $class ) {
		if ( is_object( $class ) ) {
			return $class;
		}

		$reflection = $this->getReflectionClass( $class );
		if ( $reflection->isInstantiable() ) {
			return $reflection->newInstanceWithoutConstructor();
		}

		throw new ReflectionException(
			sprintf( esc_html__( "Cannot create an instance of %s%", 'plugin-name' ), $class )
		);
	}
}
