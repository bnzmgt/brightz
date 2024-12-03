<footer class="bg-primary">
   
    <div class="relative bg-orange py-6">
        <div class="mx-auto max-w-screen-lg px-4 md:px-8">
            <div class="flex flex-col items-center justify-start gap-2 md:flex-row relative">

                <!-- Image Container -->
                <div class="hidden md:flex mb-3 text-center md:mb-0 md:text-left">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/img-cs.png" 
                        class="absolute bottom-[-24px] left-1/2 transform -translate-x-1/2 md:left-0 md:translate-x-0 w-[238px] h-[242px] object-cover">
                </div>

                <!-- Newsletter Text Content -->
                <div class="mb-3 text-center md:mb-0 md:text-left py-4 md:ml-[calc(16rem)]">
                    <h4 class="font-bold text-gray-100 text-4xl mb-4">Jadikan Klinevo #SahabatBersihmu</h4>
                    <a href="https://api.whatsapp.com/send?phone=<?php the_field('basic_whatsapp_number', 'option'); ?>&text=<?php echo urlencode('Hallo, saya ingin tahu lebih lanjut tentang Klinevo'); ?>" class="flex items-start max-w-fit rounded-full bg-transparent border border-white bg-white text-orange px-8 py-3 text-center text-sm font-medium outline-none transition duration-100 md:text-base mx-auto md:mx-0" target="_blank" rel="noopener">
                    Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-12 lg:pt-16">
        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
            <div class="mb-8 grid md:grid-cols-2 gap-12">
                <div class="footer-info">
                    <?php 
                    $footer_info = get_field('basic_footer_info', 'option');
                    if( $footer_info ): ?>
                        <div class="text-center md:text-left text-sm text-gray-400 w-full md:w-[80%]">
                            <?php if( $footer_info['basic_footer_logo'] ): ?>
                                <div class="mb-4">
                                    <a href="/" class="inline-flex items-center gap-2 text-xl font-bold text-black md:text-2xl" aria-label="logo">
                                        <img src="<?php echo esc_url($footer_info['basic_footer_logo']); ?>" aria-label="Logo Klinevo" class="img-fluid" height="34" >
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if( $footer_info['basic_footer_description'] ): ?>
                                <p class="mb-6 text-gray-400 sm:pr-8"><?php echo esc_html($footer_info['basic_footer_description']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="footer-social flex justify-center md:justify-start mt-6 items-end">
                        <?php
                            // reset choices
                            $field['choices'] = array();

                            // if has rows
                            if( have_rows('basic_social_media', 'option') ) {

                                // while has rows
                                while( have_rows('basic_social_media', 'option') ) {

                                    // instantiate row
                                    the_row();

                                    // vars
                                    $value = get_sub_field('basic_social_name');
                                    $label = get_sub_field('basic_social_link');

                                    // append to choices
                                    $field['choices'][ $value ] = $label; ?>

                                    <a href="<?php echo $label; ?>" target="_blank" rel="noopener" aria-label="Jogjaestate <?php echo $value; ?>" class="link <?php echo $value; ?>">
                                        <i class="icon-ks-<?php echo $value; ?>"></i>
                                    </a>

                                <?php }
                            }

                            // return the field
                            //return $field;
                        ?>
                    </div>
                </div>

                <div class="footer-link flex flex-col md:flex-row gap-8 md:gap-0">

                    <?php 
                        $footer_info = get_field('basic_footer_info', 'option');
                        if( $footer_info ): ?>
                            <div class="text-center md:text-left text-sm text-gray-400 w-full">
                                <?php if( $footer_info['basic_footer_links'] ): ?>
                                    <div class="text-gray-400 sm:pr-8"><?php echo wp_kses_post($footer_info['basic_footer_links']); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="text-center md:text-left text-sm text-gray-400 w-full">
                                <?php if( $footer_info['basic_footer_address'] ): ?>
                                    <div class="text-gray-400"><?php echo wp_kses_post($footer_info['basic_footer_address']); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; 
                    ?>

                </div>
            </div>

            <div class="border-t py-8 text-center md:text-left text-sm text-gray-400"><?php the_field('basic_copyright_text', 'option'); ?></div>
        </div>
    </div>
</footer>

<script>
jQuery(document).ready(function($) {
    $('#menu-toggle').on('click', function() {
        $('.menu-container').toggleClass('hidden flex navbar-collapse');
    });
});
</script>

<?php wp_footer(); ?>

</body>
</html>