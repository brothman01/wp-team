<?php
/**
 * WP Team
 *
 * @category  WordPress_Plugin
 * @package   Brothman-portfolio
 * @author    Ben Rothman <Ben@BenRothman.org>
 * @copyright 2023 Ben Rothman
 * @license   GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 *
 * Plugin Name: WP Team
 * Plugin URI: http://wordpress.org/extend/plugins/wordpress-importer/
 * Description: Import posts, pages, comments, custom fields, categories, tags and more from a WordPress export file.
 * Author: wordpressdotorg
 * Author URI: http://wordpress.org/
 * Version: 0.6.3
 * Text Domain: wordpress-importer
 * License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'unauthorized' );
}

class Br_Staff {

	public function __construct() {

		// Register Post Types.
		require_once( 'post-types/br-person.php' );

		// Enqueue CMB2.
		if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
			require_once dirname( __FILE__ ) . '/cmb2/init.php';
		} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
			require_once dirname( __FILE__ ) . '/CMB2/init.php';
		}

		// add custom row to table.
		add_filter( 'manage_posts_columns', array( $this, 'brs_columns_head' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'brs_columns_content' ), 10, 2 );

		add_shortcode( 'br_person', array( $this, 'br_person_shortcode_function' ) );

		// Add the filter to include this template.
		add_filter( 'template_include', array( $this, 'brs_include_template' ), 1 );

		// enqueue scripts, styles and react block.
		add_action( 'wp_enqueue_scripts', array( $this, 'brs_enqueue_styles' ) );

		// vc block stuff.
		include_once( plugin_dir_path( __FILE__ ) . 'vc_elements/class-teamblock.php' );
		$teamblock = new TeamBlock();

		// WordPress block actions.
		add_action( 'init', array( $this, 'brs_create_block' ) );
		add_filter( 'register_post_type_args', array( $this, 'brs_add_cpts_to_api' ), 10, 2 );
	}

	/**
	 * Single person shortcode callback function
	 * 
	 * @param  array $atts Only has one item, the id of the staff member to draw information from.
	 * 
	 * @return string The code that goes in place of the shortcode with all of the formmating and correct information.
	 * 
	 * @since 0.1
	 */
	public function br_person_shortcode_function( $atts ) {

		$attributes = shortcode_atts(
			array(
			'id'  => false,
			),
			$atts
		);

		$contents = '';

		$the_query = new WP_Query(
			array(
				'post_type' => 'br_person',
				'p' => (int) $atts['id'],
			)
		);

		// iterate through the query to build the code for the shortcode.
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
		}

		return $contents;
	}

	/**
	 * Function used to force the site to use my custom templpate for the single 'portfolio_item' page.
	 *
	 * @param string $template_path : the path to the template for a given page type in WordPress.
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
	 * @param  array $defaults : array of the columns that will show for each item in the CPT table.
	 * 
	 * @return none, changes the wp admin dashboard and add a column to a CPT.
	 * 
	 * @since 0.1
	 */
	public function brs_columns_head( $defaults ) {

		if ( 'br_person' == get_post_type() ) {
			$defaults['shortcode'] = 'Shortcode';
		}
			return $defaults;
	}

	 // show the featured image \\
	public function brs_columns_content( $column_name, $post_id ) {
		if ( 'shortcode' == $column_name ) {
				echo '<input type="text" value="[br_person id=' . esc_attr( $post_id ) . ']"></input>';
		}
	}


	/**
	 * Load stylesheets, etc.
	 */
	public function brs_enqueue_styles() {

		wp_enqueue_style( 'main-style', plugin_dir_url( __FILE__ ) . 'library/css/style.css' );

		wp_enqueue_script( 'index', plugin_dir_url( __FILE__) . 'wordpress-block-react/build/index.js', array( 'wp-element' ), '1.0.0', true );

	}

	// Show every CPT in the REST API.
	public function brs_add_cpts_to_api( $args, $post_type ) {
		if ( 'result' === $post_type ) {
			$args['show_in_rest'] = true;
		}

		return $args;
	}


	/**
	 * Add the block to the WordPress block editor
	 */
	public function brs_create_block() {
		register_block_type( __DIR__ . '/wordpress-block-vanillajs/build' );
		register_block_type( __DIR__ . '/wordpress-block-react/build' );
	}

}

$staff = new Br_Staff();
