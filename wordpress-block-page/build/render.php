<?php
$code = '';

$the_query = new WP_Query(
    array(
        'post_type' => 'br_person'
    )
);

// iterate through the query to build the code for the shortcode.
if ( $the_query->have_posts() ) {

    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $code .= '<div class="staff-member-div">
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
?>
<p <?php echo get_block_wrapper_attributes(); ?>>
<div id="team-block-page" style="overflow: hidden; max-width: 100%!important">
    <?php echo $code; ?>
</div>
</p>

