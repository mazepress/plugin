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
	 * Load template part from theme or plugin.
	 *
	 * @phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter
	 *
	 * @param string       $slug The template slug.
	 * @param string|null  $name The template name.
	 * @param array<mixed> $args The additional arguments.
	 *
	 * @return void
	 */
	public function get_template_part( string $slug, ?string $name = null, array $args = array() ): void {

		$templates = array();

		if ( ! empty( $name ) ) {
			$templates[] = "{$slug}-{$name}.php";
		}

		$templates[] = "{$slug}.php";
		$located     = '';

		foreach ( $templates as $template ) {
			$located = self::locate_template( $template );
			if ( ! empty( $located ) ) {
				require $located;
				break;
			}
		}
	}

	/**
	 * Retrieves the name of the highest priority template file that exists.
	 *
	 * @param string $template The template.
	 *
	 * @return string
	 */
	public function locate_template( string $template ): string {

		$paths         = array();
		$template_path = 'templates';
		$active_theme  = \trailingslashit( \get_stylesheet_directory() );
		$parent_theme  = \trailingslashit( \get_template_directory() );

		if ( ! empty( $this->get_path() ) ) {
			$paths[] = \trailingslashit( $this->get_path() ) . $template_path;
		}

		if ( ! empty( $this->get_parent() ) ) {
			$parent_app    = $this->get_parent();
			$active_theme .= $parent_app->get_slug() . '/' . $this->get_slug();
			$parent_theme .= $parent_app->get_slug() . '/' . $this->get_slug();

			if ( ! empty( $parent_app->get_path() ) ) {
				$paths[] = \trailingslashit( $parent_app->get_path() ) . $template_path . '/' . $this->get_slug();
			}
		} else {
			$active_theme .= $this->get_slug();
			$parent_theme .= $this->get_slug();
		}

		$paths[] = $active_theme;

		if ( $active_theme !== $parent_theme ) {
			$paths[] = $parent_theme;
		}

		/**
		 * Filters the paths for additional locations.
		 *
		 * @param string[] $paths The file path.
		 */
		$paths = \apply_filters( 'mazepressplugin_locate_template', $paths );

		$paths   = array_reverse( array_unique( $paths ) );
		$located = '';

		foreach ( $paths as $path ) {
			$file_path = \trailingslashit( $path ) . $template;
			if ( file_exists( $file_path ) ) {
				$located = $file_path;
				break;
			}
		}

		return $located;
	}

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
