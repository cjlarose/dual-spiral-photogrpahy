<?php

class SeriesCPT extends PostType {

	public $post_type = 'kali_series';

	public function __construct() {

		$args = array(
			'labels' => array(
				'name' => __( 'Series' ),
				'singular_name' => __( 'Series' )
			),
			'public' => true,
			'has_archive' => true,
			'show_ui' => TRUE,
			'rewrite' => array('slug' => 'series'),
			'supports' => array('title', 'editor', 'author'),
			'taxonomies' => array(),
			'hierarchical' => TRUE
		);
		parent::__construct($args);
	}

	public function get_all() {
		$args = array(
			'posts_per_page' => -1,
			'post_type' => $this->post_type,
			'orderby' => 'ID',
			'order' => 'ASC'
		);
		return new WP_Query($args);
	}

	/*
	public function get_all_objects() {
		$restaurant_query = $this->get_all();
		$posts = $restaurant_query->posts;
		$data = array();
		foreach ($posts as $post) {
			$datum = new stdClass();
			$datum->ID = $post->ID;
			$datum->post_title = $post->post_title;
			$datum->post_name = $post->post_name;
			$datum->post_excerpt = $post->post_excerpt;
			$datum->permalink = get_permalink($post->ID);
			$datum->facebook_link = get_post_meta($post->ID, 'facebook_link', true);
			$datum->twitter_link = get_post_meta($post->ID, 'twitter_link', true);
			$datum->thumbnail = array(
				'thumbnail' => get_the_post_thumbnail($post->ID, 'thumbnail'),
				'full' => get_the_post_thumbnail($post->ID, 'full')
			);
			$data[] = $datum;
		}
		return $data;
	}
	*/


}
