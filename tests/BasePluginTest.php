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
use Mazepress\Plugin\Tests\HelloWorld;
use WP_Mock\Tools\TestCase;


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
}
