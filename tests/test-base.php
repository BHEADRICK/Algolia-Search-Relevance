<?php
/**
 * Algolia_Search_Relevance.
 *
 * @since   0.0.1
 * @package Algolia_Search_Relevance
 */
class Algolia_Search_Relevance_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.1
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'Algolia_Search_Relevance') );
	}

	/**
	 * Test that our main helper function is an instance of our class.
	 *
	 * @since  0.0.1
	 */
	function test_get_instance() {
		$this->assertInstanceOf(  'Algolia_Search_Relevance', algolia_search_relevance() );
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
