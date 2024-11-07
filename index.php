<?php

get_header();

?>

<div class="mx-auto max-w-screen-xl px-4 md:px-8">
<div id="content" class="page c">
  <div class="page-intro">
    <?php
      $image = get_field('page_blog_detail_cover', 'option');
      if( !empty($image) ): ?>
          <div class="intro-inner" style="background-image: url('<?php echo $image['url']; ?>')">
      <?php endif; ?>
      <div class="outer-inner">
        <div class="inner-box clearfix">
          <div class="inner-box-container">
            <div class="intro-title">
              <h2>Blogaaaa</h2>
              <p>Connecting outstanding people.</p>
            </div>
          </div><!-- end .inner-container -->
        </div><!-- end .inner-box -->
      </div><!-- end .outer-inner -->
    </div><!-- end .intro-inner -->
  </div><!-- end .page-intro -->
  <div id="breadcrumbs">

    <?php breadcrumbs(); ?>

</div>
  <div class="content-wrap">
    <div class="container">
      <ul>
        <?php while ( have_posts() ) : the_post(); ?>
          <li><?php the_title(); ?></li>
          <?php the_content(); ?>
        <?php endwhile; ?>
      </ul>
      <?php wp_reset_query(); ?>
    </div><!-- end .container -->
  </div><!-- end #content -->
</div><!-- end #content -->
</div>

<?php get_footer(); ?>
