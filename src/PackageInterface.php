<?php
/**
 * The PackageInterface class file.
 *
 * @package Mazepress\Plugin
 */

declare(strict_types=1);

namespace Mazepress\Plugin;

use Mazepress\Plugin\PluginInterface;

/**
 * The PackageInterface class.
 */
interface PackageInterface {

	/**
	 * Get the package.
	 *
	 * @return PluginInterface
	 */
	public function get_package(): PluginInterface;

	/**
	 * Set the package.
	 *
	 * @param PluginInterface $package The package.
	 *
	 * @return self
	 */
	public function set_package( PluginInterface $package ): self;

	/**
	 * Get the dependent packages.
	 *
	 * @return string[]
	 */
	public function get_packages(): array;

	/**
	 * Set the dependent packages.
	 *
	 * @param string[] $packages The packages.
	 *
	 * @return self
	 */
	public function set_packages( array $packages ): self;
}
