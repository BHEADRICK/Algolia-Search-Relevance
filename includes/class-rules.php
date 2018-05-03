<?php
/**
 * Algolia Search Relevance Rules.
 *
 * @since   0.0.1
 * @package Algolia_Search_Relevance
 */

/**
 * Algolia Search Relevance Rules.
 *
 * @since 0.0.1
 */
class ASR_Rules {
	/**
	 * Parent plugin class.
	 *
	 * @since 0.0.1
	 *
	 * @var   Algolia_Search_Relevance
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  0.0.1
	 *
	 * @param  Algolia_Search_Relevance $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	public function check_hits(){

	    

    }

    public function index_settings(array $settings, $post_type){


	    if(in_array($post_type, ['product', 'product_variation'])){
            array_unshift( $settings['attributesToIndex'], 'unordered(attributes.product_categories)');
            array_unshift( $settings['attributesToIndex'], 'unordered(attributes.product_tags)');

            array_unshift($settings['customRanking'], 'desc(price)');

            foreach($settings['attributesToIndex'] as $ix=> $item){
                if(strpos($item, 'content') !== false){
                    unset($settings['attributesToIndex'][$ix]);
                }
            }

            foreach($settings['attributesToSnippet'] as $ix=>$item){
                if(strpos($item, 'content') !== false){
                    unset($settings['attributesToSnippet'][$ix]);
                }
            }

        }
        if($post_type == ' product_variation'){
	        $settings['attributeForDistinct'] = 'post_parent';
        }
        array_unshift( $settings['attributesToIndex'], 'ordered(post_title');


        error_log(print_r($settings, true));

        return $settings;
    }

    public function attributes( array $attributes, WP_Post $post ) {


        if(in_array($post->post_type, ['product', 'product_variation'])){

            $attributes['post_parent'] = $post->post_parent;

	unset($attributes['post_excerpt']);
	unset($attributes['post_author']);
}


	return $attributes;
	}

	public function indexable($should_index, WP_Post $post  ){

        if(in_array($post->post_type, ['product', 'product_variation'])){
        $tag_terms = wp_get_post_terms($post->ID, 'product_tag', ["fields" => "slugs"]);

	    if(in_array('add-on-product', $tag_terms)){
	        $should_index = false;
        }
        if($post->post_type == 'product_variation'){
	        if(is_object_in_term($post->post_parent, 'product_visibility', 'exclude-from-search') ||is_object_in_term($post->post_parent, 'product_visibility', 'exclude-from-catalog')){
	            $should_index = false;
            }

            $cat_only = get_post_meta($post->post_parent, '_catalog_only', true);
            if($cat_only === 'catalog-only'){
                $should_index = false;
            }}

        }


        $cat_only = get_post_meta($post->ID, '_catalog_only', true);
	    if($cat_only === 'catalog-only'){
	        $should_index = false;
        }

	    return $should_index;
    }
	/**
	 * Initiate our hooks.
	 *
	 * @since  0.0.1
	 */
	public function hooks() {
            add_action('asr_ga_check_page_hits', [$this, 'check_hits']);

            add_filter('algolia_posts_index_settings', [$this, 'index_settings'], 99, 2);
            add_filter('algolia_post_product_shared_attributes', [$this, 'attributes'], 99, 2);
            add_filter('algolia_should_index_post', [$this ,'indexable'], 99, 2);
	}
}
