<?php

namespace PluginName\Presentation\Public\Controllers;

use PluginName\Application\DTOs\Post\PostDto;
use PluginName\Application\Interfaces\PostServiceInterface;

defined( 'ABSPATH' ) || exit;

class PostController {
	private PostServiceInterface $service;

	public function __construct( PostServiceInterface $service ) {
		$this->service = $service;
	}

	/**
	 * @return PostDto|bool
	 */
	public function create() {
		$args = [
			'post_title'   => esc_html__( 'New Post Title', 'plugin-name' ),
			'post_content' => 'Content',
			'post_status'  => 'publish',
		];

		return $this->service->create( $args );
	}

	/**
	 * @param int $post_id
	 *
	 * @return PostDto|bool
	 */
	public function update( int $post_id ) {
		$args = [
			'ID'           => $post_id,
			'post_title'   => esc_html__( 'New Post Title Updated', 'plugin-name' ),
			'post_content' => esc_html__( 'Content updated', 'plugin-name' ),
			'post_status'  => 'publish',
		];

		return $this->service->create( $args );

	}

	/**
	 * @param int $id
	 *
	 * @return PostDto|bool
	 */
	public function get( int $id ) {
		return $this->service->get( $id );
	}

	/**
	 * @return bool|array
	 */
	public function getList() {
		$args = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => - 1
		];

		return $this->service->getList( $args );

	}

	public function delete( int $id ): bool {
		return $this->service->delete( $id );
	}
}
