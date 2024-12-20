<?php
/**
 * User repository
 *
 * Implements the UserRepositoryInterface
 *
 * @since 1.0.0
 * @package PluginName
 * @subpackage Persistence\Repositories
 */

namespace PluginName\Persistence\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Services\Mapper;
use PluginName\Domain\Models\User;
use PluginName\Domain\Repositories\UserRepositoryInterface;
use ReflectionException;

class UserRepository implements UserRepositoryInterface {

	private Mapper $mapper;

	public function __construct( Mapper $mapper ) {
		$this->mapper = $mapper;
	}

	/**
	 * Create a new model
	 *
	 * @param array $args
	 *
	 * @return User|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function create( array $args ) {
		$userId = wp_insert_user( $args );

		if ( is_wp_error( $userId ) ) {
			return false;
		}

		return $this->get( $userId );
	}

	/**
	 * Update a model
	 *
	 * @param array $args
	 *
	 * @return User|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function update( array $args ) {
		$userId = wp_update_user( $args );

		if ( is_wp_error( $userId ) ) {
			return false;
		}

		return $this->get( $userId );
	}

	/**
	 * Delete a model
	 *
	 * @param int $id
	 * @param int|null $reAssing
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function delete( int $id, int $reAssing = null ): bool {
		return wp_delete_user( $id, $reAssing );
	}

	/**
	 * Get a model
	 *
	 * @param int $id
	 *
	 * @return bool|User
	 * @throws ReflectionException
	 */
	public function get( int $id ) {
		$getUser = get_user_by( 'ID', $id );

		if ( ! $getUser ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $getUser, User::class );
	}

	/**
	 * Get a list of models
	 *
	 * @param array $args
	 *
	 * @return User[]|bool
	 * @throws ReflectionException
	 */
	public function getList( array $args ): array {
		$getUsers = get_users( $args );

		$users = [];
		if ( count( $getUsers ) > 0 ) {
			foreach ( $getUsers as $user ) {
				$mappedUser = $this->mapper->mapArrayToObject( $user, User::class );
				$users[]    = $mappedUser;
			}

			return $users;
		} else {
			return false;
		}
	}
}
