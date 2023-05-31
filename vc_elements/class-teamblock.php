<?php
/** WP Team
 *
 * @category  WordPress_Plugin
 * @package   WP-Team
 * @author    Ben Rothman <Ben@BenRothman.org>
 * @copyright 2023 Ben Rothman
 * @license   GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Teamblock class for vc
 *
 * @since 1.1
 */
class TeamBlock {

	/**
	 * Teamblock for vc contructor.  The constructor performs all of the methods necesarry to use this block correctly.
	 *
	 * @since 1.1
	 */
	public function __construct() {
		// add shortcode for the addon.
		add_shortcode( 'teamblock', array( $this, 'teamblock_callback' ) );

		// add the VCMap function for the addon.
		add_action( 'vc_before_init', array( $this, 'teamblock_vcmap' ) );

	}

	/**
	 * Teamblock for vc callback to define what is shown in place of the block
	 *
	 * @param array  $atts : an array of the attributes included in the shortcode on the page.
	 *
	 * @param string $content : the actual code that should be shown inside the block created by Visual Composer.
	 *
	 * @since 1.1
	 */
	public function teamblock_callback( $atts, $content ) {
		$teamblock_atts = shortcode_atts(
			array(
				'title'      => false,
				'hide_title' => false,
				'content'    => false,
				'alternate'  => false,
			),
			$atts
		);

		// The Query.
		$the_query = new WP_Query(
			array(
				'post_type' => 'br_person',
				'orderby'   => 'title',
				'order'     => 'ASC',
			)
		);

		// The Loop.
		if ( $the_query->have_posts() ) {
			$content .= '<div class="staff-rows">';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$content .= '<div class="staff-member-div" style="float:left; width: 100%">
							<a href="' . get_permalink() . '">
								<div class="span4" style="float: left; padding-top: 10px;  width: 33%;  text-align: center;">
									<img class="staff-portrait" src="' . esc_attr( get_post_meta( get_the_ID(), 'br_portrait', true ) ) . '" style="width: 124px; margin: 0px auto" />
									<br />
									<p class="title-text" style="padding: 0px 0px 0px 0px!important; text-align: center;">' . esc_attr( get_post_meta( get_the_ID(), 'br_title', true ) ) . '</p>
								</div>
							</a>

				<div class="span8">
						<div class="name-text"><b>' . esc_attr( get_post_meta( get_the_ID(), 'br_name', true ) ) . '</b></div>
						<div class="bio-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_bio', true ) ) . '</div>
				</div>

				</div>';
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			$content = '<p>No staff members to show.  Please fill out staff members on the WP dashboard to populate this page.</p>';
		}
		$content .= '</div>';
		if ( $teamblock_atts['alternate'] ) {
			$content .= '<style>
			.staff-member-div:nth-child(even) {background: #CCC}
			</style>';
		}

		return '<div>' . $content . '</div>';
	}

	/**
	 * Define the fields for the Teamblock vc block
	 *
	 * @since 1.1
	 */
	public function teamblock_vcmap() {
		vc_map(
			array(
				'name'        => 'teamblock',
				'base'        => 'teamblock',
				'description' => 'A teamblock',
				'icon'        => 'icon-wpb-ui-tta-section',
				'class'       => 'teamblock',
				'category'    => 'WP Team',
				'params'      => array(
					array(
						'type'        => 'textarea_html',
						'heading'     => 'Main Content',
						'param_name'  => 'content',
						'description' => '',
						'save_always' => true,
						'admin_label' => true,
						'group'       => 'Primary Box',
					),
					array(
						'type'        => 'checkbox',
						'heading'     => 'Alternate Row Colors?',
						'param_name'  => 'alternate',
						'description' => '',
						'save_always' => true,
						'admin_label' => true,
						'group'       => 'Primary Box',
					),
				),
			)
		);
	}
}
