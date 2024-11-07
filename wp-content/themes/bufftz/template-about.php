<?php
/**
 * Template Name: About Us
 */

get_header();

?>
<div id="content" class="page">
    <div class="page-intro">
        <?php if( get_field('cover_image_about') ): ?>
        <div class="intro-inner" style="background-image: url('<?php the_field('cover_image_about'); ?>')">
        <?php endif; ?>
            <div class="outer-inner">
                <div class="container inner-box clearfix">
                    <div class="inner-box-container">
                        <div class="intro-title">
                            <h1><?php the_title(); ?> </h1>
                        </div>
                    </div><!-- end .inner-container -->
                </div><!-- end .inner-box -->
            </div><!-- end .outer-inner -->
        </div><!-- end .intro-inner -->
    </div>
    <!-- end .page-intro -->

    <div class="content-wrap margintb-50 padding-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php the_field('pa_description'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end .content-wrap -->

    <div class="content-wrap margintb-50 padding-30">
        <div class="container">
            <div class="box-heading side-dash section-ourteam">
                <div class="uniheading text-left heading">
                    <h2>Tim Kami</h2>
                </div>
            </div>
            <div class="row">
                <div class="team-box">
                    <?php
                        // check if the repeater field has rows of data
                        if( have_rows('about_team') ):

                            // loop through the rows of data
                            while ( have_rows('about_team') ) : the_row(); ?>
                                <div class="box-team">
                                    <div class="team-image">
                                        <img src="<?php the_sub_field('team_image'); ?>" alt="" class="img-fluid">

                                    </div>
                                    <div class="team-info">
                                        <p class="team-name"><?php the_sub_field('team_name'); ?></p>
                                        <p><?php the_sub_field('team_position'); ?></p>
                                    </div>
                                </div>
                                <?php
                            endwhile;

                        else :

                            echo 'nothing found';

                        endif;
                    ?>
                </div><!-- end .team-box -->
            </div>
        </div>
    </div>
    <!-- end .content-wrap -->

    <div class="content-wrap margintb-50 padding-30 use-color-background legality">
        <div class="container">
            <div class="box-heading side-dash section-ourteam">
                <div class="uniheading text-left heading">
                    <h2>Legalitas</h2>
                </div>
            </div>
            <div class="row">
                <?php
                    if ( have_rows( 'about_legal' ) ):;
                    $i = 1;
                        while ( have_rows( 'about_legal' ) ) : the_row();
                        $idv = get_sub_field( 'legal_image' );?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="unibox uniblog uniblog__duo transform marginbot-30">
                                    <a data-fancybox data-src="#fancybox-thumb-<?php echo $i; ?>" href="javascript:;" title="" rel="fancybox-thumb-<?php echo $i; ?>">
                                        <h3>
                                            <img src="<?php echo get_bloginfo('template_url') ?>/img/icon-picture.png" alt="" title="" class="img-fluid">
                                            <?php the_sub_field('legal_name'); ?>
                                        </h3>
                                    </a>
                                    <p style="padding: 10px 0;"><?php the_sub_field('legal_description'); ?></p>

                                    <div style="display: none; width: 1140px;" id="fancybox-thumb-<?php echo $i; ?>">
                                        <img src="<?php echo esc_url( $idv['url']); ?>" class="img-fluid"/>
                                    </div>
                                </div>
                            </div>

                    <?php  $i++;
                        endwhile;
                    endif;
                ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <!-- end .content-wrap -->

    <section class="part-invitation marginbot-40 padding-tbxlarge">
        <div class="container">
            <div class="box-invitation">
                <?php the_field('invitation_note', 'option'); ?>
                <a href="https://api.whatsapp.com/send?phone=<?php the_field('whatsapp_number', 'option'); ?>" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo get_bloginfo('template_url') ?>/img/icon_whatsapp.png" alt="" title="" class="img-fluid"> Konsultasi Sekarang</a>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>
