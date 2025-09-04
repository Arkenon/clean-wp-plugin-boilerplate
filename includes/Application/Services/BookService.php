<?php
/**
 * Book Service for Book post type
 *
 * This class implements the methods defined in the Post Service Interface and includes the methods to interact with the Book Repository
 *
 * @package PluginName
 * @subpackage PluginName\Application\Services
 * @since 1.0.0
 */

namespace PluginName\Application\Services;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\DTOs\Post\BookDto;
use PluginName\Application\Interfaces\BookServiceInterface;
use PluginName\Common\Tools\Mapper;
use PluginName\Domain\Repositories\BookRepositoryInterface;
use ReflectionException;


class BookService extends PostService implements BookServiceInterface {
	private BookRepositoryInterface $repository;
	private Mapper $mapper;
	private string $model;

	public function __construct( BookRepositoryInterface $repository, Mapper $mapper, string $model = BookDto::class ) {
		parent::__construct( $repository, $mapper, $model );
		$this->repository = $repository;
		$this->mapper     = $mapper;
		$this->model      = $model;
	}

	/**
	 * Get Book by ISBN
	 *
	 * @param string $isbn
	 *
	 * @return BookDto|null
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getByIsbn( string $isbn ): ?BookDto {
		$get_book =  $this->repository->getByIsbn( $isbn );
		return $this->mapper->mapObjectToObject( $get_book, $this->model);
	}
}
