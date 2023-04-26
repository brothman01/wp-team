<?php
/*
Plugin Name: WP Team
Plugin URI: http://wordpress.org/extend/plugins/wordpress-importer/
Description: Import posts, pages, comments, custom fields, categories, tags and more from a WordPress export file.
Author: wordpressdotorg
Author URI: http://wordpress.org/
Version: 0.6.3
Text Domain: wordpress-importer
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
if ( ! defined( 'ABSPATH' ) ) {
	die( 'unatuhorized' );
}

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

		/**
		 * Add the filter to run this function whenever the hook is hit.
		 */
		add_filter( 'template_include', [ $this, 'brs_include_template' ], 1 );

		add_action( 'wp_enqueue_scripts', [ $this, 'brs_enqueue_styles' ] );


		// vc block stuff \\
		include_once( plugin_dir_path( __FILE__ ) . 'vc_elements/class-teamblock.php' );
		$teamblock = new TeamBlock();
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
		} else {
			// no posts found
		}

		 return $contents;
	}

	/**
	* Function used to force the site to use my custom templpate for the single 'portfolio_item' page.
	*
	* @since 0.1
	*/
	public function brs_include_template( $template_path ) {

		if ( get_post_type() == 'br_person' ) {
				$theme_file = plugin_dir_path( __FILE__ ) . 'single-person.php';
				$template_path = $theme_file;
		}

		return $template_path;

	}

	/**
	 * Add new column for shortcodes to the CPT table.
	 * @param  array $defaults array of the columns that will show for each item in the CPT table.
	 * @return [type]           [description]
	 */
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

		wp_enqueue_style( 'main-style', plugin_dir_url( __FILE__ ) . 'library/css/styl.css' );

	}

}

$staff = new Br_Staff();
