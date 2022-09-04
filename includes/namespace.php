<?php

/**
 * Main functionality for Post UUID.
 */

declare( strict_types=1 );

namespace Jazz\PostUUID;

use Closure;
use Ramsey\Uuid\Uuid;

use function add_action;
use function add_filter;
use function get_permalink;
use function wp_generate_uuid4;
use function wp_slash;

/**
 * Bootstraps the main hooks.
 */
function bootstrap() : void {
	add_filter( 'wp_insert_post_data', __NAMESPACE__ . '\\filter_wp_insert_post_data' );
	add_filter( 'wp_insert_attachment_data', __NAMESPACE__ . '\\filter_wp_insert_post_data' );
}

/**
 * Adds a UUID to new posts or new attachments.
 *
 * @listens filter:wp_insert_post_data
 * @listens filter:wp_insert_attachment_data
 *
 * This filter is documented in {@see wp_insert_post()}.
 *
 * @param  array<array-key, mixed> $data An array of slashed, sanitized, and processed
 *     post or attachment data.
 * @return array<array-key, mixed> The data with the replaced UUID.
 */
function filter_wp_insert_post_data( array $data ) : array {
	if ( empty( $data['guid'] ) ) {
		$data['guid'] = wp_slash( format_uuid_urn( generate_uuid() ) );
	}

	return $data;
}

/**
 * Finds a peer or fallback UUID generator function.
 */
function find_peer_uuid_generator() : Closure {
	return function () {
		return wp_generate_uuid4();
	};
}

/**
 * Finds a user-defined or peer UUID generator function.
 */
function find_uuid_generator() : Closure {
	/**
	 * Allows {@see find_uuid_generator()} to be short-circuited,
	 * by returning a UUID generator.
	 *
	 * @param Closure|null $pre_generator The UUID generator.
	 */
	$pre_generator = apply_filters( 'jazz/post_uuid/generator/pre_discovery', null );

	/**
	 * This annotation is required until support for
	 * {@link humanmade/psalm-plugin-wordpress#24 custom hooks} is merged.
	 *
	 * @var Closure|null $pre_generator
	 */

	if ( ! is_null( $pre_generator ) ) {
		return $pre_generator;
	}

	$generator = find_peer_uuid_generator();

	/**
	 * Filters the UUID generator discovered by {@see find_uuid_generator()}.
	 *
	 * @param Closure $pre_generator The UUID generator.
	 */
	return apply_filters( 'jazz/post_uuid/generator/discovery', $generator );
}

/**
 * Generates a UUID.
 */
function generate_uuid() : string {
	$generator = get_uuid_generator();

	return $generator();
}

/**
 * Generates a URN from a UUID.
 *
 * @param string $uuid A UUID to format.
 */
function format_uuid_urn( string $uuid ) : string {
	return sprintf( 'urn:uuid:%s', $uuid );
}

/**
 * Retrieves the UUID generator.
 */
function get_uuid_generator() : Closure {
	static $generator = null;

	if ( is_null( $generator ) ) {
		$generator = find_uuid_generator();
	}

	return $generator;
}
