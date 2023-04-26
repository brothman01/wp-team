<?php

if ( ! defined('ABSPATH' ) ) {
	die();
}

class TeamBlock {

	public function __construct() {
		// add shortcode for the addon \\
		add_shortcode( 'teamblock', [ $this, 'teamblock_callback'] );

		// add the VCMap function for the addon \\
		add_action( 'vc_before_init', [ $this, 'teamblock_vcmap'] );

	}
	
	public function teamblock_callback( $atts, $content ) {
		$teamblock_atts = shortcode_atts( array(
			'title' => false,
			'hide_title' => false,
		), $atts );

// The Query
$the_query = new WP_Query( [
	'post_type' => 'br_person',
]);

// The Loop
if ( $the_query->have_posts() ) {

	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$content .= '<div class="staff-member-div">
					<a href="' . get_permalink() . '">
						<div class="span4">
							<img class="staff-portrait" src="' . esc_attr( get_post_meta( get_the_ID(), 'br_portrait', true ) ) . '" />
							<p class="title-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_title', true ) ) . '</p>
						</div>
					</a>

		<div class="span8">
				<div class="name-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_name', true ) ) . '
				<div class="cool-underline" style="width: 40%;"><div style="background: #E6E6E6; width: 80%; height: 4px; position: relative; bottom: 0%; margin-left: 20%;"></div></div></div>
				 <div class="bio-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_bio', true ) ) . '</div>
		</div>

		</div>';
	}
	/* Restore original Post Data */
	wp_reset_postdata();
		}

		return '<div>' . $content . '</div>';
	}

	public function teamblock_vcmap() {
		vc_map( array(
			'name' => 'teamblock',
			'base' => 'teamblock',
			'description' => 'A teamblock',
			'icon' => 'icon-wpb-ui-tta-section',
			'class' => 'teamblock',
			'category' => 'WP Team',
			'params' => array(),
		));
	}
}