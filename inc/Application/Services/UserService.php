<?php

namespace PluginName\Application\UseCases;

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
	 * @param array $args
	 *
	 * @return UserDto|bool
	 * @throws ReflectionException
	 */
	public function create( array $args ) {
		$user = $this->repository->create( $args );

		if ( ! $user ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $user, UserDto::class );
	}

	/**
	 * @param array $args
	 *
	 * @return UserDto|bool
	 * @throws ReflectionException
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
	 * @param int $id
	 *
	 * @return UserDto|bool
	 * @throws ReflectionException
	 */
	public function get( int $id ) {
		$user = $this->repository->get( $id );

		if ( ! $user ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $user, UserDto::class );
	}

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 * @throws ReflectionException
	 */
	public function getList( array $args ) {
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
