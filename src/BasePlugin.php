<?php
/**
 * The BasePlugin class file.
 *
 * @package Mazepress\Plugin
 */

declare(strict_types=1);

namespace Mazepress\Plugin;

use Mazepress\Plugin\PluginInterface;

/**
 * The BasePlugin class.
 */
abstract class BasePlugin implements PluginInterface {

	/**
	 * The parent.
	 *
	 * @var PluginInterface $parent
	 */
	private $parent;

	/**
	 * The base url.
	 *
	 * @var string|null $url
	 */
	private $url;

	/**
	 * The base path.
	 *
	 * @var string|null $path
	 */
	private $path;

	/**
	 * If an instance exists, returns it. If not, creates one and retuns it.
	 *
	 * @return self
	 */
	abstract public static function instance();

	/**
	 * Initialize the package features.
	 *
	 * @return void
	 */
	abstract public static function init(): void;

	/**
	 * Get the package name.
	 *
	 * @return string
	 */
	abstract public function get_name(): string;

	/**
	 * Get the package slug.
	 *
	 * @return string
	 */
	abstract public function get_slug(): string;

	/**
	 * Get the package version.
	 *
	 * @return string
	 */
	abstract public function get_version(): string;

	/**
	 * Get the parent.
	 *
	 * @return PluginInterface|null
	 */
	public function get_parent(): ?PluginInterface {
		return $this->parent;
	}

	/**
	 * Set the parent.
	 *
	 * @param PluginInterface $parent The parent.
	 *
	 * @return self
	 */
	public function set_parent( PluginInterface $parent ): self {
		$this->parent = $parent;
		return $this;
	}

	/**
	 * Get the base url.
	 *
	 * @return string|null
	 */
	public function get_url(): ?string {
		return $this->url;
	}

	/**
	 * Set the base url.
	 *
	 * @param string $url The base url.
	 *
	 * @return self
	 */
	public function set_url( string $url ): self {
		$this->url = $url;
		return $this;
	}

	/**
	 * Get the base path.
	 *
	 * @return string|null
	 */
	public function get_path(): ?string {
		return $this->path;
	}

	/**
	 * Set the base path.
	 *
	 * @param string $path The base path.
	 *
	 * @return self
	 */
	public function set_path( string $path ): self {
		$this->path = $path;
		return $this;
	}
}
