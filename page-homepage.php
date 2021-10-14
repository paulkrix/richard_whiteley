<?php get_header(); ?>
<main id="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-content">
    <?php the_content(); ?>
  </div>
</div>
<?php endwhile; endif; ?>
</main>
<script>
    let images = jQuery(".image-fade .blocks-gallery-item");
    let index = 0;
    images.eq(index).addClass('visible');
    console.log(images.length);
    function fade() {
        console.log('fading');
        images.eq(index).addClass('visible');
        images.eq(index-1).removeClass('visible');
        index = (index + 1) % images.length;
        setTimeout(fade, 4000);
    }
    fade();
</script>
<?php get_footer(); ?>