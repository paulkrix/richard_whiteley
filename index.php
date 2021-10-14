<?php get_header(); ?>
<main id="content" class="news-page-content">
<?php $args = array(
    'tag' => 'news',
    'posts_per_page' => 0
); ?>
<?php $query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</main>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>