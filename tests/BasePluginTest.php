<?php
/**
 * The BasePluginTest class file.
 *
 * @package    Mazepress\Plugin
 * @subpackage Tests
 */

declare(strict_types=1);

namespace Mazepress\Plugin\Tests;

use Mazepress\Plugin\BasePlugin;
use Mazepress\Plugin\PluginInterface;
use Mazepress\Plugin\Tests\Stubs\HelloWorld;
use Mazepress\Plugin\Tests\Stubs\HelloWorldParent;
use WP_Mock\Tools\TestCase;
use WP_Mock;


/**
 * The BasePluginTest class.
 */
class BasePluginTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$object = HelloWorld::instance();

		$this->assertInstanceOf( PluginInterface::class, $object );
		$this->assertInstanceOf( BasePlugin::class, $object );
		$this->assertEquals( 'HelloWorld', $object->get_name() );
		$this->assertEquals( 'hello-world', $object->get_slug() );
		$this->assertEquals( '1.0.0', $object->get_version() );

		$this->assertInstanceOf( HelloWorld::class, $object->set_url( 'http://example.com' ) );
		$this->assertEquals( 'http://example.com', $object->get_url() );

		$this->assertInstanceOf( HelloWorld::class, $object->set_path( 'path/to/plugin' ) );
		$this->assertEquals( 'path/to/plugin', $object->get_path() );

		$this->assertInstanceOf( HelloWorld::class, $object->set_parent( $object ) );
		$this->assertEquals( $object, $object->get_parent() );
	}

	/**
	 * Test get_template_part.
	 *
	 * @return void
	 */
	public function test_get_template_part(): void {

		$instance = HelloWorld::instance();
		$instance->set_path( __DIR__ );

		WP_Mock::userFunction( 'get_stylesheet_directory' )
			->andReturn( 'theme' );

		WP_Mock::userFunction( 'get_template_directory' )
			->andReturn( 'child-theme' );

		$instance->get_template_part( 'test', 'one' );

		WP_Mock::assertActionsCalled();
	}

	/**
	 * Test locate_template.
	 *
	 * @return void
	 */
	public function test_locate_template(): void {

		$instance = HelloWorldParent::instance();
		$instance->set_path( __DIR__ );

		$template = 'test-one.php';
		$path     = __DIR__ . '/templates';

		WP_Mock::userFunction( 'get_stylesheet_directory' )
			->andReturn( 'theme' );

		WP_Mock::userFunction( 'get_template_directory' )
			->andReturn( 'child-theme' );

		$located = $instance->locate_template( $template );
		$this->assertEquals( $path . '/' . $template, $located );

		$parent = HelloWorld::instance();
		$instance->set_parent( $parent );

		$located = $instance->locate_template( $template );
		$this->assertEquals( $path . '/' . $template, $located );
	}
}
