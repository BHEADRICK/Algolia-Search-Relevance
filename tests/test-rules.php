<?php
/**
 * Algolia Search Relevance Rules Tests.
 *
 * @since   0.0.1
 * @package Algolia_Search_Relevance
 */
class ASR_Rules_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.1
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'ASR_Rules' ) );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.0.1
	 */
	function test_class_access() {
		$this->assertInstanceOf( 'ASR_Rules', algolia_search_relevance()->rules );
	}

	/**
	 * Replace this with some actual testing code.
	 *
	 * @since  0.0.1
	 */
	function test_sample() {
		$this->assertTrue( true );
	}
}
