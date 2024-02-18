<?php
/**
 * The PluginInterface class file.
 *
 * @package Mazepress\Plugin
 */

declare(strict_types=1);

namespace Mazepress\Plugin;

/**
 * The PluginInterface class.
 */
interface PluginInterface {

	/**
	 * Initialize the package features.
	 *
	 * @return void
	 */
	public static function init(): void;

	/**
	 * Get the package name.
	 *
	 * @return string
	 */
	public function get_name(): string;

	/**
	 * Get the package slug.
	 *
	 * @return string
	 */
	public function get_slug(): string;

	/**
	 * Get the package version.
	 *
	 * @return string
	 */
	public function get_version(): string;

	/**
	 * Get the parent.
	 *
	 * @return PluginInterface|null
	 */
	public function get_parent(): ?PluginInterface;

	/**
	 * Set the parent.
	 *
	 * @param PluginInterface $parent The parent.
	 *
	 * @return self
	 */
	public function set_parent( PluginInterface $parent ): self;

	/**
	 * Get the base url.
	 *
	 * @return string|null
	 */
	public function get_url(): ?string;

	/**
	 * Set the base url.
	 *
	 * @param string $url The base url.
	 *
	 * @return self
	 */
	public function set_url( string $url ): self;

	/**
	 * Get the base path.
	 *
	 * @return string|null
	 */
	public function get_path(): ?string;

	/**
	 * Set the base path.
	 *
	 * @param string $path The base path.
	 *
	 * @return self
	 */
	public function set_path( string $path ): self;
}
