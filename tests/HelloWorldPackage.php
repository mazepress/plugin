<?php
/**
 * The HelloWorldPackage stub class file.
 *
 * @package    Mazepress\Plugin
 * @subpackage Tests
 */

namespace Mazepress\Plugin\Tests;

use Mazepress\Plugin\BasePackage;
use Mazepress\Plugin\PluginInterface;

/**
 * The HelloWorldPackage class.
 */
class HelloWorldPackage extends BasePackage {

	/**
	 * Addon packages or plugins.
	 * Where the array `key` = Package name and `value` = Package Entry class.
	 *
	 * @example array( 'Core' => 'Mazepress\\Core\\App' )
	 *
	 * @var string[]
	 */
	private $packages = array(
		'HelloWorldAnother' => 'Mazepress\\Plugin\\Tests\\HelloWorldAnother',
	);

	/**
	 * Initiate class.
	 *
	 * @param PluginInterface $package The package.
	 */
	public function __construct( PluginInterface $package ) {
		$this->set_package( $package );
	}

	/**
	 * Get the admin message.
	 *
	 * @param string $package The package name.
	 * @param string $parent  The parent package name.
	 *
	 * @return string
	 */
	public function get_package_missing_message( string $package, string $parent ): string {
		return wp_sprintf(
			/* translators: 1: The package. 2: Plugin name */
			esc_html__(
				'The package %1$s is missing, which is required by the %2$s plugin',
				'mazepressplugin'
			),
			'<code>' . esc_html( $package ) . '</code>',
			'<code>' . esc_html( $parent ) . '</code>'
		);
	}

	/**
	 * Get the dependent packages.
	 *
	 * @return string[]
	 */
	public function get_packages(): array {
		return $this->packages;
	}

	/**
	 * Set the dependent packages.
	 *
	 * @param string[] $packages The packages.
	 *
	 * @return self
	 */
	public function set_packages( array $packages ): self {
		$this->packages = $packages;
		return $this;
	}
}
