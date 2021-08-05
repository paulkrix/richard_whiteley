<?php get_header(); ?>
<main id="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">
<?php the_content(); ?>
</div>
</article>
<?php endwhile; endif; ?>
</main>
<script>
    let images = jQuery(".image-fade .blocks-gallery-item");
    let index = 0;
    images.eq(index).toggleClass('visible');
    console.log(images.length);
    function fade() {
        images.eq(index).toggleClass('visible');
        index = (index + 1) % images.length;
        setTimeout(fade, 3000);
    }
    setTimeout(fade, 3000);
</script>
<?php get_footer(); ?>