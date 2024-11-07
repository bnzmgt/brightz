<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php wp_head(); ?>
<!-- Additional Favicon and Icons -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>favicon-16x16.png">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body <?php body_class(); ?>>

<div class="navbar navbar-light bg-light navbar-expand-lg" role="navigation">
    <div class="mx-auto max-w-screen-xl px-4 md:px-8">
        <header class="flex items-center justify-between py-4 md:py-8">
        
            <div class="logo-top">
                <?php if ( wp_is_mobile() ) : ?>
                    <?php
                        $image = get_field('header_logo_mobile', 'option');
                        if( !empty($image) ) :
                    ?>
                        <a class="navbar-brand page-scroll" href="<?php echo home_url(); ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="header-logo img-fluid" width="171" height="36" /></a>
                    <?php endif;
                    else :
                        $image = get_field('header_logo', 'option');
                        if( !empty($image) ) :
                        ?>
                            <a class="navbar-brand page-scroll" href="<?php echo home_url(); ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="header-logo img-fluid" width="171" height="36" /></a>
                        <?php endif; ?>
                <?php endif; ?>
            </div>

            <?php
                wp_nav_menu( array(
                    'theme_location'    => 'primary',
                    'depth'             => 1, // Set to 1 if you don’t need sub-menus
                    'container'         => 'nav',
                    'container_class'   => 'hidden lg:flex gap-8 items-center',
                    //'menu_class'        => 'flex flex-wrap space-x-4',
                    'items_wrap'        => '%3$s',
                    'fallback_cb'       => false,
                    'walker'            => new Custom_Walker_Nav_Menu(),
                ));
            ?>

            <button type="button" class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-2.5 py-2 text-sm font-semibold text-gray-500 ring-indigo-300 hover:bg-gray-300 focus-visible:ring active:text-gray-700 md:text-base lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>

            Menu
            </button>
        
        </header>
    </div>
</div>


