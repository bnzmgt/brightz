<?php

/*
 * Template Name: Featured Article
 * Template Post Type: post, page, product
 */

get_header();

?>

<div id="content" class="page">
    <div class="content-wrap">
        <div class="container">
            <div class="row">
                <?php
                if (have_posts()): while (have_posts()) : the_post(); ?>

                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="box-list">
                        <?php the_post_thumbnail( 'large', array('class' => 'img-fluid') );?>
                        <h1><?php the_title();?></h1>
                        <div class="meta">
                            <span class="author"><i class="ti-user"></i>by <?php the_author(); ?></span>
                            <span class="date"><i class="ti-calendar"></i><?php echo get_the_date('d F Y', strtotime('post_date')); ?></span>
                        </div>
                        <div class="contentblog">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div><!-- end .col-md-8 -->

                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <aside class="sidebar sidebar-right">
                        <div class="widget">
                            <div class="widget blog-heading blog-recent-post">
                                <h3 class="widget-title">Recent Post</h3>
                                <ul>
                                    <?php
                                        $args = array(
                                             'posts_per_page' => '3', 
                                             'category_name' => 'artikel'
                                            );
                                        $recent_posts = new WP_Query($args);
                                        while( $recent_posts->have_posts() ) :
                                            $recent_posts->the_post() ?>
                                            <li>
                                                <a href="<?php echo get_permalink() ?>" class="category-link" title="<?php the_title() ?>"><?php the_title() ?></a>
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <?php the_post_thumbnail('thumbnail', array('title' => get_the_title() )); ?>
                                                <?php endif ?>
                                                <span class="comment"><i class="ti-calendar"></i><?php the_time('d F Y', strtotime('post_date')); ?></span>
                                            </li>
                                        <?php endwhile; ?>
                                        <?php wp_reset_postdata(); # reset post data so that other queries/loops work
                                    ?>
                                </ul>
                            </div><!-- end .widget -->
                        </div><!-- end .widget -->
                    </aside>
                </div><!-- end .col-md-4 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </div><!-- end .content-wrap -->
</div><!-- end #content -->

<?php get_footer(); ?>
