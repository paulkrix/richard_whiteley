<?php $args = array(
'prev_text' => sprintf( esc_html__( '%s older', 'richardwhiteley' ), '<span class="meta-nav">&larr;</span>' ),
'next_text' => sprintf( esc_html__( 'newer %s', 'richardwhiteley' ), '<span class="meta-nav">&rarr;</span>' )
);
the_posts_navigation( $args ); ?>