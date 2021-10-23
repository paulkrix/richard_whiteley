<!-- <div class="entry-summary"> -->
<?php if ( has_post_thumbnail() ) : ?>
<!-- <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> -->
<?php the_post_thumbnail('thumbnail', array('class'=>'summary-thumb')); ?>
<?php the_post_thumbnail('wider-thumbnail', array('class'=>'summary-thumb-wide')); ?>
<!-- </a> -->
<?php endif; ?>
<div class="entry-summary">
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <?php the_content(); ?>
</div>
<?php if ( is_search() ) { ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
<?php } ?>
<!-- </div> -->