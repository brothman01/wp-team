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
	'orderby' => 'title',
	'order'   => 'ASC',
]);

// The Loop
if ( $the_query->have_posts() ) {

	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$content .= '<div class="staff-member-div" style="float:left; width: 100%; border: solid red 1px;">
					<a href="' . get_permalink() . '">
						<div class="span4" style="float: left; padding-top: 10px;  width: 33%;  text-align: center;">
							<img class="staff-portrait" src="' . esc_attr( get_post_meta( get_the_ID(), 'br_portrait', true ) ) . '" style="width: 124px; margin: 0px auto" />
							<br />
							<p class="title-text" style="padding: 0px 0px 0px 0px!important; text-align: center;">' . esc_attr( get_post_meta( get_the_ID(), 'br_title', true ) ) . '</p>
						</div>
					</a>

		<div class="span8">
				<div class="name-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_name', true ) ) . '</div>
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