<?php
/**
 * Template Name: Pricing Uno Template
 */

get_header(); ?>

<div class="content-info my-8 font-sans">
    
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
      
    <!-- Pricing Section Title -->
    <h2 class="mb-8 text-center text-2xl font-bold text-gray-800 md:mb-12 lg:text-3xl">
        <?php echo get_field('price_section_heading'); ?>
    </h2>

    <?php if (have_rows('price_groups')): ?>
        <div class="wrapper">
            <div class="group">

                <?php while (have_rows('price_groups')): the_row(); 
                    // Fetch group data
                    $group_name = get_sub_field('price_group_name');
                    $group_image = get_sub_field('price_group_image');
                    $group_note = get_sub_field('price_group_note');
                    $variants = get_sub_field('variants');
                    
                    // New variables 
                    $show_booking_button = get_field('show_booking'); // Toggle for Booking Button
                    $show_pricing_description = get_field('show_description'); // Toggle for Description
                    $whatsapp_number = get_field('basic_whatsapp_number', 'option'); // WhatsApp number
                    $pricing_section_title = get_field('price_section_heading');

                ?>
                
                    <?php if ($group_name || $group_image || $variants): ?>
                        <div class="odd:bg-white even:bg-slate-50">
                            <div class="mx-auto max-w-screen-xl px-4 md:px-8">
                                <div class="inner price_groups flex flex-col gap-6 items-start justify-start py-10">
                                    <!-- Group Bio -->
                                    <div class="group-bio w-full md:w-1/4 items-center justify-start">
                                        <div class="py-2 text-center">
                                            <?php if ($group_image): ?>
                                                <img src="<?php echo esc_url($group_image); ?>" alt="Image Service" class="mb-4" >
                                            <?php endif; ?>
                                            
                                            <?php if ($group_name): ?>
                                                <h2 class="group-name rounded-xl text-xl md:text-2xl font-bold py-4 bg-blue-light text-white"><?php echo esc_html($group_name); ?></h2>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Group Items -->
                                    <?php if ($variants): ?>
                                        <div class="group-items w-full">
                                            <div class="grid gap-6 md:grid-cols-3 lg:gap-4">
                                                <?php foreach ($variants as $index => $variant): 
                                                    // Fetch variant data
                                                    $variant_image = $variant['variants_image'];
                                                    $variant_name = $variant['variants_name'];
                                                    $variant_price = $variant['variants_price'];
                                                    $variant_special_price = $variant['variants_special_price'];
                                                    $variant_excerpt = $variant['variants_excerpt'];
                                                    $variant_description = $variant['variants_description'];

                                                    // WhatsApp Booking Variables
                                                    $pricing_type = $variant_name;
                                                    $booking_message = 'Hallo, saya ingin tahu lebih lanjut tentang Paket ' . esc_html($pricing_type);

                                                    $unique_id = $index . '-' . substr(md5($variant_name), 0, 6);
                                                    
                                                ?>
                                                    <?php if ($variant_image || $variant_name || $variant_price || $variant_excerpt || $variant_description): ?>
                                                        <div class="item variants flex items-center justify-center p-4 border rounded-lg hover:shadow-md hover:bg-white">
                                                            <div class="w-1/3 shrink-0">                                                
                                                                <div class="h-20 w-20 overflow-hidden rounded-full bg-gray-100 shadow-lg md:h-20 md:w-20 shrink-0">
                                                                    <?php if ($variant_image): ?>
                                                                        <img src="<?php echo esc_url($variant_image); ?>" alt="" class="h-full w-full object-cover object-center">
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <div class="w-2/3">                                                
                                                                <?php if ($variant_name): ?>
                                                                    <h3 class="item-name text-lg font-bold leading-6 pb-4 text-blue-light"><?php echo esc_html($variant_name); ?></h3>
                                                                <?php endif; ?>
                                                                                                                
                                                                <?php if ($variant_price || $variant_special_price): ?>
                                                                    <div class="flex items-baseline">
                                                                        <span class="mr-1 text-sm">Rp.</span>
                                                                        <?php if (!empty($variant_special_price)): ?>
                                                                            <!-- Show special price -->
                                                                            <p class="item-special-price text-xl md:text-2xl font-medium pb-4 md:pb-4 tracking-tight text-red-500"><?php echo esc_html($variant_special_price); ?></p>
                                                                            <!-- Show variant_price with strikethrough -->
                                                                            <p class="item-price text-md font-normal line-through text-gray-500 ml-2 tracking-tight"><?php echo esc_html($variant_price); ?></p>
                                                                            
                                                                        <?php else: ?>
                                                                            <!-- Show variant_price only -->
                                                                            <p class="item-price text-xl md:text-2xl font-medium pb-4 md:pb-4 tracking-tight"><?php echo esc_html($variant_price); ?></p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                                
                                                                <?php if ($variant_excerpt): ?>
                                                                    <div class="excerpt mb-4 text-sm"><?php echo wp_kses_post($variant_excerpt); ?></div>
                                                                <?php endif; ?>
                                                                
                                                                <!-- Description -->
                                                                <?php if ($show_pricing_description && is_array($show_pricing_description)): ?>
                                                                    <?php 
                                                                    // Loop through the checkbox array and check the value
                                                                    $is_enabled = false;
                                                                    foreach ($show_pricing_description as $option) {
                                                                        if (isset($option['value']) && $option['value'] === '1') {
                                                                            $is_enabled = true;
                                                                            break;
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <?php if ($is_enabled && !empty($variant_description) ): ?>
                                                                        <div class="pb-4 -mt-3">
                                                                            <a href="#modal-description-<?php echo $unique_id; ?>" data-fancybox class="inline-block text-blue-light text-center text-xs font-medium transition duration-100">
                                                                                Selengkapnya
                                                                            </a>
                                                                            <!-- Fancybox Modal Content -->
                                                                            <div style="display: none;" id="modal-description-<?php echo $unique_id;; ?>">
                                                                                <div class="p-4">
                                                                                    <h3 class="mb-4 text-xl font-bold"><?php echo esc_html($variant_name); ?></h3>
                                                                                    <p><?php echo $variant['variants_description']; ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <!-- Booking Button -->
                                                                <?php if ($show_booking_button && is_array($show_booking_button)): ?>
                                                                    <?php 
                                                                    // Loop through the checkbox array and check the value
                                                                    $is_enabled = false;
                                                                    foreach ($show_booking_button as $option) {
                                                                        if (isset($option['value']) && $option['value'] === '1') {
                                                                            $is_enabled = true;
                                                                            break;
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <?php if ($is_enabled && $whatsapp_number): ?>
                                                                        <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp_number); ?>&text=<?php echo urlencode($booking_message); ?>" 
                                                                        class="flex items-start max-w-fit rounded-full border border-white bg-orange text-white px-4 py-[6px] text-center text-xs font-normal outline-none transition duration-100" 
                                                                        target="_blank" rel="noopener">
                                                                        Booking Sekarang!
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>

                                            <?php if ($group_note): ?>
                                                <p class="group-note text-xs text-red-500 font-normal my-4"><?php echo esc_html($group_note); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>                                 
        </div>
    <?php endif; ?>

</div>

<?php get_footer(); ?>