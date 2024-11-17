<?php
/**
 * Template Name: Pricing Template
 */

get_header(); ?>

<div class="content-info my-8 md:my-0 font-sans">
    
    <?php
        // Loop through the posts
        while ( have_posts() ) : the_post(); 
            // Check if there is content for the current post
            if ( trim(get_the_content()) ) : ?>
                <div class="mx-auto max-w-screen-xl px-4 md:px-8">
                    <div class="py-6 sm:py-8 lg:py-20">
                        <div class="entry-content-page">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php 
            endif;
        endwhile; // End of the loop
        wp_reset_query(); // Reset the query
    ?>
        

    <?php if( have_rows('pricing_info') ): ?>
        <?php while ( have_rows('pricing_info') ) : the_row(); ?>
            
            <!-- Pricing Layout -->
            <?php if( get_row_layout() == 'pricing' ): ?>
                <?php 
                $variants = get_sub_field('variant');
                if( $variants ): ?>
                    <div class="pricing-section bg-white py-6 sm:py-8 lg:py-20">
                        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
                            <h2 class="mb-8 text-center text-2xl font-bold text-gray-800 md:mb-16 lg:text-3xl">Our Pricing</h2>
                            <div class="grid gap-6 md:grid-cols-3 lg:gap-6">
                            <?php foreach( $variants as $index => $variant ): ?>
                                    <div class="pricing-variant shadow-md text-center">
                                        <?php if( $variant['pricing_type'] ): ?>
                                            <h4 class="py-8 text-center font-light text-lg bg-blue-light text-white"><?php echo esc_html($variant['pricing_type']); ?></h4>
                                        <?php endif; ?>
                                        <?php if( $variant['pricing_number'] ): ?>
                                            <p class="text-3xl font-normal p-4 md:p-8">Rp. <?php echo esc_html($variant['pricing_number']); ?></p>
                                        <?php endif; ?>
                                        <?php if( $variant['pricing_excerpt'] ): ?>
                                            <div class="pb-10 px-4 md:px-10 content-info"><?php echo $variant['pricing_excerpt']; ?></div>
                                        <?php endif; ?>
                                        <?php if( $variant['pricing_description'] ): ?>
                                            <!-- Add Fancybox Trigger -->
                                            <div class="pb-10 px-4 md:px-8">
                                                <a href="#modal-description-<?php echo $index; ?>" data-fancybox class="inline-block text-blue-light px-6 py-2 text-center text-sm font-medium transition duration-100 md:text-base">
                                                    Selengkapnya
                                                </a>
                                                <!-- Fancybox Modal Content -->
                                                <div style="display: none;" id="modal-description-<?php echo $index; ?>">
                                                    <div class="p-4">
                                                        <h3 class="mb-4 text-xl font-bold"><?php echo esc_html($variant['pricing_type']); ?></h3>
                                                        <p><?php echo $variant['pricing_description']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>


        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>