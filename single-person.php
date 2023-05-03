<?php
/*
Template Name: Single Person
*/
?>

<?php get_header(); ?>

<?php

wp_register_style( 'millenium_single-product',  plugin_dir_url( __FILE__ ) . '/library/css/single.css', false, '1.0.0' );
wp_enqueue_style( 'millenium_single-product' );

wp_register_script( 'carousel_script', plugin_dir_url( __FILE__ ) . '/library/js/jquery.carouFredSel-6.1.0-packed.js', array( 'jquery' ), 'all', true );
wp_enqueue_script( 'carousel_script' );

wp_register_script( 'cp_script', plugin_dir_url( __FILE__ ) . '/library/js/chatpress.js', array( 'jquery' ), 'all', true );
wp_enqueue_script( 'cp_script' );

?>

<div class="container">

	<div id="content" class="clearfix row">

		<div id="main" class="col-md-12 clearfix" role="main">


				<div class="staff-member-div">
							<div class="span4">
								<img class="staff-portrait" src="' . esc_attr( get_post_meta( get_the_ID(), 'br_portrait', true ) ) . '" />
								<p class="title-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_title', true ) ) . '</p>
							</div>

					<div class="span8">
							<div class="name-text"> <?php esc_attr( get_post_meta( get_the_ID(), 'br_name', true ) ); ?>
							<div class="cool-underline" style="width: 40%;"><div style="background: #E6E6E6; width: 80%; height: 4px; position: relative; bottom: 0%; margin-left: 20%;">
							</div>
						</div>
					</div>

						<div class="bio-text">' . esc_attr( get_post_meta( get_the_ID(), 'br_bio', true ) ) . '</div>
			</div>

			</div>';


		</div> <!-- end #main -->

	</div> <!-- end #content -->

</div> <!-- end .container -->

<?php get_footer(); ?>
