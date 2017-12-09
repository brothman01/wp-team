<?php
/*
Plugin Name: Staff-brothman
Plugin URI: http://wordpress.org/extend/plugins/wordpress-importer/
Description: Import posts, pages, comments, custom fields, categories, tags and more from a WordPress export file.
Author: wordpressdotorg
Author URI: http://wordpress.org/
Version: 0.6.3
Text Domain: wordpress-importer
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
if ( ! defined('ABSPATH') ) { die( 'unatuhorized' ); }
class Br_Staff {

	public function __construct() {

		/* Register Post Types */
		require_once( 'post-types/br-person.php' );

		// Enqueue CMB2
		if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
			require_once dirname( __FILE__ ) . '/cmb2/init.php';
		} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
			require_once dirname( __FILE__ ) . '/CMB2/init.php';
		}

		// add custom row to table
		add_filter( 'manage_posts_columns', [ $this, 'brs_columns_head' ] );
		add_action( 'manage_posts_custom_column', [ $this, 'brs_columns_content' ], 10, 2 );

		add_shortcode( 'br_person', [ $this, 'br_person_shortcode_function' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'brs_enqueue_styles' ] );
	}

	/**
 * [br_person_shortcode_function description]
 * @param  array $atts Is an array although only item of the array is the id of the staff member to use.
 * @return [type]       [description]
 */
	public function br_person_shortcode_function( $atts ) {

		$attributes = shortcode_atts( array(
			'id'  => false,
		), $atts );

		$contents = '';

		// The Query
		$the_query = new WP_Query( [
			'post_type' => 'br_person',
			'p' => (int) $atts['id'],
		]);

		// The Loop
		if ( $the_query->have_posts() ) {

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$contents .= '<div class="staff-member-div">
								<div class="span4">
									<img class="staff-portrait" src="' . esc_attr( get_post_meta( get_the_ID(), 'br_portrait', true ) ) . '" />
									<p class="title-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_title', true ) ) . '</p>
								</div>

				<div class="span8">
						<div class="name-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_name', true ) ) . '
						<div class="cool-underline" style="width: 40%;"><div style="background: #E6E6E6; width: 80%; height: 4px; position: relative; bottom: 0%; margin-left: 20%;"></div></div></div>
						 <div class="bio-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_bio', true ) ) . '</div>
				</div>

				</div>';
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			// no posts found
		}

		 return $contents;
	}

	 // ADD NEW COLUMN
	public function brs_columns_head( $defaults ) {

		if ( 'br_person' == get_post_type() ) {
			 $defaults['shortcode'] = 'Shortcode';
		}
			return $defaults;
	}

	 // SHOW THE FEATURED IMAGE
	public function brs_columns_content( $column_name, $post_id ) {
		if ( 'shortcode' == $column_name ) {
				echo '<input type="text" value="[br_person id=' . esc_attr( $post_id ) . ']"></input>';
		}
	}


	/*
	 * Load stylesheets, etc.
	 */
	public function brs_enqueue_styles() {

		wp_enqueue_style( 'main-style', plugin_dir_url( __FILE__ ) . 'library/css/style.css' );

	}

}

$staff = new Br_Staff();
