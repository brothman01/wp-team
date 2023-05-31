<?php
/** WP Team
 *
 * @category  WordPress_Plugin
 * @package   WP-Team
 * @author    Ben Rothman <Ben@BenRothman.org>
 * @copyright 2023 Ben Rothman
 * @license   GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 *
 * Template Name: Single Person
 */

?>

<?php get_header(); ?>

<div class="container">

	<div id="content" class="clearfix row">

		<div id="main" class="col-md-12 clearfix" role="main">


				<div class="staff-member-div">
							<div class="span4">
								<img class="staff-portrait" style="margin: 0px auto;" src="<?php echo esc_attr( get_post_meta( get_the_ID(), 'br_portrait', true ) ); ?>" />
								<p class="title-text"> <?php echo esc_attr( get_post_meta( get_the_ID(), 'br_title', true ) ); ?> </p>
							</div>

					<div class="span8">
							<div class="name-text"> <?php echo esc_attr( get_post_meta( get_the_ID(), 'br_name', true ) ); ?>
							<div class="cool-underline" style="width: 40%;">
								<div style="background: #E6E6E6; width: 80%; height: 4px; position: relative; bottom: 0%; margin-left: 20%;">
							</div>
						</div>
					</div>

						<div class="bio-text"><?php echo esc_attr( get_post_meta( get_the_ID(), 'br_bio', true ) ); ?></div>
			</div>

			</div>


		</div> <!-- end #main -->

	</div> <!-- end #content -->

</div> <!-- end .container -->

<?php get_footer(); ?>
