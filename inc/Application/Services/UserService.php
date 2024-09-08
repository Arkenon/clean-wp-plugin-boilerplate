<?php

namespace PluginName\Application\Services;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\DTOs\User\UserDto;
use PluginName\Application\Interfaces\UserServiceInterface;
use PluginName\Common\Services\Mapper;
use PluginName\Domain\Repositories\UserRepositoryInterface;
use ReflectionException;

class UserService implements UserServiceInterface {

	private UserRepositoryInterface $repository;
	private Mapper $mapper;

	public function __construct( UserRepositoryInterface $repository, Mapper $mapper ) {
		$this->repository = $repository;
		$this->mapper     = $mapper;
	}

	/**
	 * Create a new DTO for a related model
	 *
	 * @param array $args
	 *
	 * @return UserDto|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function create( array $args ) {
		$user = $this->repository->create( $args );

		if ( ! $user ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $user, UserDto::class );
	}

	/**
	 * Update a DTO for a related model
	 *
	 * @param array $args
	 *
	 * @return UserDto|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function update( array $args ) {
		$user = $this->repository->update( $args );

		if ( ! $user ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $user, UserDto::class );
	}

	public function delete( int $id, int $reAssing = null ): bool {
		return $this->repository->delete( $id, $reAssing );
	}

	/**
	 * Get a DTO for a related model
	 *
	 * @param int $id
	 *
	 * @return UserDto|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function get( int $id ) {
		$user = $this->repository->get( $id );

		if ( ! $user ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $user, UserDto::class );
	}

	/**
	 * Get a list of DTOs for a related model
	 *
	 * @param array $args
	 *
	 * @return array|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getList( array $args ): array {
		$users = $this->repository->getList( $args );

		if ( ! $users ) {
			return false;
		}

		$userList = [];
		foreach ( $users as $user ) {
			$mappedUser = $this->mapper->mapObjectToObject( $user, UserDto::class );
			$userList[] = $mappedUser;
		}

		return $userList;
	}
}
