<?php

class PostType {

	public function __construct($args) {
		register_post_type($this->post_type, $args);
	}

	protected function get_posts($args) {
		if (!array_key_exists('post_type', $args))
			$args['post_type'] = $this->post_type;
		$query = new WP_Query($args);
		return $query->posts;
	}

}
