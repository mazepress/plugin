<?php
/**
 * The BasePackageTest class file.
 *
 * @package    Mazepress\Plugin
 * @subpackage Tests
 */

declare(strict_types=1);

namespace Mazepress\Plugin\Tests;

use Mazepress\Plugin\BasePackage;
use Mazepress\Plugin\PackageInterface;
use Mazepress\Plugin\Tests\HelloWorld;
use Mazepress\Plugin\Tests\HelloWorldPackage;
use WP_Mock\Tools\TestCase;
use WP_Mock;


/**
 * The BasePackageTest class.
 */
class BasePackageTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$plugin = HelloWorld::instance();
		$object = new HelloWorldPackage( $plugin );

		$this->assertInstanceOf( PackageInterface::class, $object );
		$this->assertInstanceOf( BasePackage::class, $object );
		$this->assertInstanceOf( HelloWorld::class, $object->get_package() );
		$this->assertInstanceOf( HelloWorldPackage::class, $object->set_package( $plugin ) );
	}

	/**
	 * Test load method.
	 *
	 * @return void
	 */
	public function test_load(): void {

		$plugin = HelloWorld::instance();
		$object = new HelloWorldPackage( $plugin );
		$packs  = array(
			'HelloWorld' => 'Mazepress\\Plugin\\Tests\\HelloWorld',
		);

		$this->assertInstanceOf( HelloWorldPackage::class, $object->set_packages( $packs ) );
		$this->assertEquals( $packs, $object->get_packages() );

		WP_Mock::expectActionAdded( 'example_action', \WP_Mock\Functions::type( 'callable' ) );
		$object->load();
		WP_Mock::assertActionsCalled();
	}

	/**
	 * Test load method.
	 *
	 * @return void
	 */
	public function test_load_error(): void {

		$plugin = HelloWorld::instance();
		$object = new HelloWorldPackage( $plugin );
		$packs  = array(
			'PackageOne' => 'Mazepress\\Plugin\\Tests\\PackageOne',
		);

		$this->assertInstanceOf( HelloWorldPackage::class, $object->set_packages( $packs ) );
		$this->assertEquals( $packs, $object->get_packages() );

		WP_Mock::userFunction( 'wp_sprintf' )->once()->andReturn( 'The package not found' );
		WP_Mock::expectActionAdded( 'admin_notices', \WP_Mock\Functions::type( 'callable' ) );
		$object->load();
		WP_Mock::assertActionsCalled();
	}
}
